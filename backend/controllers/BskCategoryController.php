<?php

namespace backend\controllers;

use Yii;
use common\models\BskCategory;
use common\models\BskCategoryOther;
use backend\models\search\BskCategoryOtherSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BskCategoryController implements the CRUD actions for BskCategoryOther model.
 */
class BskCategoryController extends Controller
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
     * Lists all BskCategoryOther models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BskCategoryOtherSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // 获取分类信息
        $categories = [];
        $ids = [];
        foreach($dataProvider->getModels() as $model) {
            $ids[] = $model->grade_id;
            $ids[] = $model->semester_id;
            $ids[] = $model->science_id;
            $ids[] = $model->syllabus_id;
            $ids[] = $model->category_id;
        }
        $ids = array_unique($ids);
        if ($ids) {
            $categories = BskCategory::find()
                ->select('id, name')
                ->andWhere([ 'id' => $ids ])
                ->all();
            $categories = $categories ? ArrayHelper::map($categories, 'id', 'name') : [];
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }

    /**
     * Displays a single BskCategoryOther model.
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
     * Creates a new BskCategoryOther model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->dealEdit();
    }
    public function dealEdit($id = null) {
        $isUpdate = !!$id;
        $model = $isUpdate ? $this->findModel($id) : new BskCategoryOther();
        $tpl = $isUpdate ? 'update' : 'create';
        $ret = ['model' => $model];

        if (Yii::$app->request->isPost) {
            $type = Yii::$app->request->post('type');
            $model->setScenario($type == BskCategoryOther::CATEGORY_TYPE_POINT ? 'point' : 'other');
            $model->load(Yii::$app->request->post());
            $model->type = $type;
            if (!$model->validate()) { // 通过该项保证先做rules校验
                return $this->render($tpl, $ret);
            }

            // 获取所有主分类
            $cs = BskCategory::find()
                ->select('id, name, lft, rgt, lvl, root')
                ->andWhere(['id'=>[
                    $model->grade_id, $model->semester_id,
                    $model->science_id, $model->syllabus_id,
                    $model->category_id,
                ]])
                ->all();
            $cs = ArrayHelper::index($cs, 'id');

            // 如果只有semester，需要获取其grade
            if ($model->semester_id && !$model->grade_id) {
                $semester = $cs[$model->semester_id];
                if ($semester->isLeaf() && $semester->lvl === 2) {
                    $grade = $semester->parents(1)->one();
                    $model->grade_id = $grade->id;
                    $cs[$grade->id] = $grade;
                } else {
                    $model->addError('semester_id', '请选择具体的学期');
                    return $this->render($tpl, $ret);
                }
            }

            // 检查新设置的值是否重复
            $exists = BskCategoryOther::find()
                ->select('id')
                ->andWhere([
                    'type' => $model->type,
                    'grade_id' => $model->grade_id,
                    'semester_id' => $model->semester_id,
                    'science_id' => $model->science_id,
                    'syllabus_id' => $model->syllabus_id,
                ])
                ->all();
            if ($exists) {
                $existsIds = ArrayHelper::map($exists, 'id', 'id');
                unset($existsIds[$model->id]);
                if (count($existsIds)) {
                    Yii::$app->session->setFlash('alert', ['body' => '分类设置已存在', 'options' => ['class'=>'alert-error']]);
                    return $this->render($tpl, $ret);
                }
            }

            // 设置新分类名称
            $name = BskCategoryOther::types()[$model->type] .'分类';
            $name .= isset($cs[$model->grade_id]) ? '_' . $cs[$model->grade_id]->name : '';
            $name .= isset($cs[$model->semester_id]) ? '_' . $cs[$model->semester_id]->name : '';
            $name .= isset($cs[$model->science_id]) ? '_' . $cs[$model->science_id]->name : '';
            $name .= isset($cs[$model->syllabus_id]) ? '_' . $cs[$model->syllabus_id]->name : '';

            // 生成对应的根分类
            $root = $isUpdate ? $cs[$model->category_id] : new BskCategory();
            $root->name = $name;
            if (!$isUpdate) {
                $root->makeRoot();
                $model->category_id = $root->id;
            }

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        // 未提交成功返回创建表单
        return $this->render($tpl, $ret);
    }

    /**
     * Updates an existing BskCategoryOther model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        return $this->dealEdit($id);
    }

    /**
     * Deletes an existing BskCategoryOther model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = BskCategoryOther::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BskCategoryOther model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BskCategoryOther the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BskCategoryOther::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * 基础分类设置：年级、学期、学科、大纲版本
     */
    public function actionCategory() {
        return $this->render('category');
    }
}
