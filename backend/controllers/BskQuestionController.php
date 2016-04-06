<?php

namespace backend\controllers;

use Yii;
use common\models\BskQuestion;
use backend\models\search\BskQuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use common\models\BskCategoryOther;
use backend\models\QuestionForm;

/**
 * BskQuestionController implements the CRUD actions for BskQuestion model.
 */
class BskQuestionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all BskQuestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BskQuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BskQuestion model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BskQuestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // 获取所有章节、考点分类的rootID
        $roots = BskCategoryOther::find()
            ->select('type, category_id')
            ->andWhere([ 'type' => [BskCategoryOther::CATEGORY_TYPE_CHAPTER, BskCategoryOther::CATEGORY_TYPE_POINT]])
            ->all();
        $chapterRoots = [];
        $pointRoots = [];
        foreach ($roots as $root) {
            if ($root->type == BskCategoryOther::CATEGORY_TYPE_POINT) {
                $pointRoots[] = $root->category_id;
            } else {
                $chapterRoots[] = $root->category_id;
            }
        }

        // 加载到对应的form model中
        $model = new QuestionForm();
        $tpl = 'create';
        $ret = [
            'model' => $model,
            'chapterRoots' => $chapterRoots,
            'pointRoots' => $pointRoots,
        ];

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            // 保存试题
            $question = new BskQuestion();
            $question->chapter_id = $model->chapter_id;
            $question->type = $model->type;
            $question->title = $model->title;
            $question->info = $model->info;
            $question->level = round($model->difficult * 100);
            if (!$question->save()) {
                $model->addErrors($question->getErrors());
                return $this->render($tpl, $ret);
            }

            // 保存试题与考点关系
            $point_ids = explode(',', $model->point_ids);
            if (!empty($point_ids)) {
                foreach($point_ids as $point_id) {
                    if (!$point_id) continue;
                    $point = new BskQuestionPoint();
                    $point->question_id = $question->id;
                    $point->point_id = $point_id;
                    $point->save();
                }
            }
            // 保存成功后跳转到详情
            return $this->redirect(['view', 'id' => $question->id]);
        }

        return $this->render($tpl, $ret);
    }

    /**
     * Updates an existing BskQuestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BskQuestion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = BskQuestion::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BskQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BskQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BskQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
