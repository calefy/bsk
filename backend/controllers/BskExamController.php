<?php

namespace backend\controllers;

use Yii;
use common\models\BskExam;
use backend\models\search\BskExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use common\models\BskCategoryOther;

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

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BskExam model.
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
}
