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
use common\models\BskQuestionPoint;
use backend\models\QuestionForm;
use trntv\filekit\actions\UploadAction;

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

    public function actions()
    {
        return [
            'image-upload' => [
                'class' => UploadAction::className(),
                'responseFormat' => \yii\web\Response::FORMAT_HTML,
            ],
        ];
    }
    public function afterAction($action, $result)
    {
            if ($action->id === 'image-upload') { // 处理ckeditor返回格式
                if ($result['files']) {
                    $file = $result['files'][0];
                    $num = Yii::$app->request->get('CKEditorFuncNum');
                    $url = isset($file['url']) ? $file['url'] : '';
                    $err = isset($file['errors']) ? $file['errors'] : '';
                    return "<script>window.parent.CKEDITOR.tools.callFunction({$num}, '{$url}', '{$err}');</script>";
                }
            }
            $result = parent::afterAction($action, $result);
            return $result;
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
        return $this->edit();
    }

    /**
     * Updates an existing BskQuestion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->edit($id);
    }

    public function edit($id = null)
    {
        $isUpdate = !!$id;
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

        // 编辑时，获取原对象
        $question = null;
        $org_point_ids = [];
        if ($isUpdate) {
            $tpl = 'update';
            $question = BskQuestion::findOne($id);
            $points = BskQuestionPoint::find()->select('point_id')->andWhere(['question_id' => $id])->all();
            $model->id = $id;
            $model->chapter_id = $question->chapter_id;
            $model->type = $question->type;
            $model->title = $question->title;
            $model->info = $question->info;
            $model->analyze = $question->analyze;
            $model->answer = $question->answer;
            $model->comment = $question->comment;
            $model->difficult = $question->level / 100;
            $org_point_ids = ArrayHelper::getColumn($points, 'point_id');
            $model->point_ids = implode(',', $org_point_ids);
        } else {
            $question = new BskQuestion();
        }

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            // 保存试题
            $question->chapter_id = $model->chapter_id;
            $question->type = $model->type;
            $question->title = $model->title;
            $question->info = $model->info;
            $question->analyze = $model->analyze;
            $question->answer = $model->answer;
            $question->comment = $model->comment;
            $question->level = round($model->difficult * 100);
            if (!$question->save()) {
                $model->addErrors($question->getErrors());
                return $this->render($tpl, $ret);
            }

            // 保存试题与考点关系
            $point_ids = explode(',', $model->point_ids);
            if (!empty($point_ids)) {
                $sames = array_intersect($point_ids, $org_point_ids);
                $toDels = array_diff($org_point_ids, $sames);
                $toAdd = array_diff($point_ids, $sames);
                if ($toDels) {
                    BskQuestionPoint::updateAll(
                        ['status' => BskQuestionPoint::STATUS_DELETED],
                        ['point_id' => $toDels, 'question_id' => $id]);
                }
                if ($toAdd) {
                    foreach($toAdd as $point_id) {
                        if (!$point_id) continue;
                        $point = new BskQuestionPoint();
                        $point->question_id = $question->id;
                        $point->point_id = $point_id;
                        $point->save();
                    }
                }
            }
            // 保存成功后跳转到详情
            return $this->redirect(['view', 'id' => $question->id]);
        }

        return $this->render($tpl, $ret);
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
