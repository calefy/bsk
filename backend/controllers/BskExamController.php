<?php

namespace backend\controllers;

use Yii;
use common\models\BskExam;
use common\models\BskExamQuestion;
use backend\models\search\BskExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

use common\models\BskCategory;
use common\models\BskCategoryOther;
use common\models\BskQuestion;

/**
 * BskExamController implements the CRUD actions for BskExam model.
 */
class BskExamController extends Controller
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
     * Lists all BskExam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BskExamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // 获取分类信息
        //$models = $dataProvider->getModels();
        //$cids = ArrayHelper::getColumn($models, 'category_id');
        //$cs = BskCategory::find()->select('id, name')->andWhere(['id' => $cids])->all();
        //$cmap = [];
        //if ($cs) {
        //    $cmap = ArrayHelper::map($cs, 'id', 'name');
        //}

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'categoryMap' => $cmap,
        ]);
    }

    /**
     * Displays a single BskExam model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        // 试卷的试题
        $questions = $model->getQuestions()
            ->select('id,type,title,info,level')
            ->addOrderBy(['type' => SORT_ASC])
            ->all();
        return $this->render('view', [
            'model' => $model,
            'questions' => $questions,
        ]);
    }

    /**
     * Creates a new BskExam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->edit();
    }

    /**
     * Updates an existing BskExam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->edit($id);
    }

    public function edit($id = null) {
        $isUpdate = !!$id;

        // 获取所有章节、考点分类的rootID
        $roots = BskCategoryOther::find()
            ->select('category_id')
            ->andWhere([ 'type' => BskCategoryOther::CATEGORY_TYPE_EXAM ])
            ->all();
        $examRoots = ArrayHelper::getColumn($roots, 'category_id');

        $model = $isUpdate ? $this->findModel($id) : new BskExam();
        $tpl = $isUpdate ? 'update' : 'create';
        $ret = [
            'model' => $model,
            'examRoots' => $examRoots,
        ];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render($tpl, $ret);
        }
    }

    /**
     * Deletes an existing BskExam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = BskExam::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BskExam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BskExam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BskExam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionQuestionSelect($exam_id, $q=null) {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        // 获取试卷已有的试题ID
        $qids = BskExamQuestion::find()->andWhere(['exam_id' => $exam_id])->select('question_id')->all();
        $qids = ArrayHelper::getColumn($qids, 'question_id');
        $qids = $qids ? $qids : [];
        // 查找之外的试题
        $query = BskQuestion::find()
                    ->select('id,title,type')
                    ->andWhere(['not in', 'id', $qids])
                    ->limit(30);
        if ($q) {
            $query->andWhere(['like', 'title', $q]);
        }
        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return [
            'list' => $provider->getModels(),
            'total' => $provider->getTotalCount(),
        ];
    }
    public function actionQuestionSelected() {
        $exam_id = Yii::$app->request->post('exam_id');
        $sels = Yii::$app->request->post('sels');
        if ($exam_id && $sels) {
            foreach($sels as $sel) {
                $rel = new BskExamQuestion();
                $rel->exam_id = $exam_id;
                $rel->question_id = $sel;
                $rel->save();
            }
        }
        return $this->redirect(['view', 'id' => $exam_id]);
    }
}
