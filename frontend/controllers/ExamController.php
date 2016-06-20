<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
use yii\web\ServerErrorHttpException;
use yii\data\Pagination;
use yii\data\Sort;

use common\models\BskQuestion;
use common\models\BskExam;
use common\models\BskCategory;
use common\models\BskCategoryOther;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ExamController extends Controller
{

    /**
     * 试卷分类筛选页面
     * @param $g 班级ID
     * @param $s 学科ID
     * @param $l 大纲版本ID
     * @param $m 学期ID
     * @param $c 所属扩展分类ID
     */
    public function actionCategory($g=null, $s=null, $l=null, $m=null, $c=null) {
        $gradeSubjects = getDealedGradeSubjects();
        // 确定班级、学科ID
        if (!($g && isset($gradeSubjects['gradeMap'][$g]) &&
                $s && isset($gradeSubjects['subjectMap'][$s]))) {
            $g = $gradeSubjects['first']['g'];
            $s = $gradeSubjects['first']['s'];
        }

        // 获取所有的版本信息
        $syllabusRoot = BskCategory::findOne(Yii::$app->params['syllabusRootId']);
        if (!$syllabusRoot) {
            throw new ServerErrorHttpException('获取大纲版本Root信息失败');
        }
        $syllabus = $syllabusRoot->leaves()->all();
        if (!$syllabus) {
            throw new ServerErrorHttpException('获取大纲版本信息失败');
        }
        $syllabusMap = ArrayHelper::map($syllabus, 'id', 'name');
        if (empty($l) || !isset($syllabusMap[$l])) {
            $l = $syllabus[0]->id;
        }

        // 获取学期
        $grade = BskCategory::findOne($g);
        $semesters = $grade->leaves()->select('id,name')->all();
        if (!$semesters) {
            throw new ServerErrorHttpException('获取学期信息失败');
        }
        $semesterMap = ArrayHelper::map($semesters, 'id', 'name');
        if (empty($m) || !isset($semesterMap[$m])) {
            $m = $semesters[0]->id;
        }


        // 根据 g、s、l、m 获取对应的扩展分类
        $extraCategories = null;
        $extraRoot = BskCategoryOther::find()
            ->select('category_id')
            ->andWhere([
                'grade_id' => $g,
                'semester_id' => $m,
                'science_id' => $s,
                'syllabus_id' => $l,
                'type' => 3, // 试卷类型
            ])
            ->one();
        if ($extraRoot) {
            $extraCategories = BskCategory::find()
                ->select('id,name,lft,rgt')
                ->andWhere(['root' => $extraRoot->category_id])
                ->andWhere(['<>', 'id', $extraRoot->category_id])
                ->orderBy(['lft' => SORT_ASC])
                ->all();
            if ($extraCategories) {
                $ids = ArrayHelper::getColumn($extraCategories, 'id');
                if (!in_array($c, $ids)) {
                    $c = $ids[0];
                }
            }
        }

        // 选中父级分类，需要查询包含子分类的数据
        $cids = null;
        if (isset($ids)) {
            $curCategoryObj = null;
            $cids = [$c];
            foreach($extraCategories as $item) {
                if ($c == $item->id) {
                    if ($item->rgt - $item->lft > 1) {
                        $curCategoryObj = $item;
                    } else {
                        break;
                    }
                } else {
                    if ($curCategoryObj) {
                        if ($curCategoryObj->rgt > $item->rgt) {
                            $cids[] = $item->id;
                        } else {
                            break;
                        }
                    }
                }
            }
        }

        // 根据以上参数查询试卷
        $sort = new Sort([
            'defaultOrder' => [
                'created_at' => SORT_DESC,
                'title' => SORT_ASC,
            ],
            'attributes' => [
                'created_at' => [
                    'label' => '上载日期',
                    'default' => SORT_DESC,
                ],
                'title' => ['label' => '试卷名称'],
            ],
        ]);
        $query = BskExam::find()
            ->andWhere(['category_id' => $cids]);
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $exams = $query
                    ->orderBy($sort->orders)
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

        // 返回数据到页面
        return $this->render('category', [
            'req' => ['g' => $g, 's' => $s, 'l' => $l, 'm' => $m, 'c' => $c],
            'gradeSubjects' => $gradeSubjects,
            'curGradeSubjectName' => $gradeSubjects['gradeMap'][$g].$gradeSubjects['subjectMap'][$s],

            'syllabus' => $syllabus,
            'curSyllabusName' => $syllabusMap[$l],

            'semesters' => $semesters,
            'curSemesterName' => $semesterMap[$m],

            'extraCategories' => $extraCategories ? ArrayHelper::toArray($extraCategories) : null,

            'sort' => $sort,
            'exams' => $exams,
            'pages' => $pages,
        ]);
    }

    /**
     * 试卷详情页面
     */
    public function actionView($id)
    {
        $model = BskExam::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        // 试卷的试题
        $questions = $model->getQuestions()
            ->select('id,type,title,info,level')
            ->addOrderBy(['type' => SORT_ASC])
            ->all();

        return $this->render('view', ['model'=>$model, 'questions' => $questions]);
    }

}

