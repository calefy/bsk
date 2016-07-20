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
use common\models\BskQuestionPoint;
use common\models\BskCategory;
use common\models\BskCategoryOther;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class QuestionController extends Controller
{

    // 检索类型
    const SEARCH_TYPES = [
        BskCategoryOther::CATEGORY_TYPE_CHAPTER => '按章节',
        BskCategoryOther::CATEGORY_TYPE_POINT => '按考点',
    ];
    // 题型
    const QUESTION_TYPES = [
        0 => '全部',
        BskQuestion::QUESTION_TYPE_SELECT => '选择题',
        BskQuestion::QUESTION_TYPE_FILL => '填空题',
        BskQuestion::QUESTION_TYPE_ASK => '解答题',
    ];
    // 难度
    const QUESTION_LEVELS = [
        '全部', '基础', '中档', '难题'
    ];

    /**
     *
     */
    public function actionView($id)
    {
        $model = BskQuestion::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }
        return $this->render('view', ['model'=>$model]);
    }

    /**
     * 试题分类筛选页面
     * @param $g 班级ID
     * @param $s 学科ID
     * @param $t 检索类型: 章节或考点
     * @param $l 大纲版本ID
     * @param $m 学期ID
     * @param $c 所属扩展分类ID
     *
     * @param $qt 题型（选择、填空等）BskQuestion::types()
     * @param $ql 难度（0-全部，1-基础，2-中档，3-难题）
     */
    public function actionCategory($g=null, $s=null, $t=null, $l=null, $m=null, $c=null, $qt=0, $ql=0) {
        $gradeSubjects = getDealedGradeSubjects();
        // 确定班级、学科ID
        if (!($g && isset($gradeSubjects['gradeMap'][$g]) &&
                $s && isset($gradeSubjects['subjectMap'][$s]))) {
            $g = $gradeSubjects['first']['g'];
            $s = $gradeSubjects['first']['s'];
        }

        // 确定检索类型
        $t = intval($t);
        if (!in_array($t, array_keys(self::SEARCH_TYPES))) {
            $t = BskCategoryOther::CATEGORY_TYPE_CHAPTER;
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
                'type' => $t,
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

        // 题型
        $qt = intval($qt);
        if (!in_array($qt, array_keys(self::QUESTION_TYPES))) {
            $qt = 0;
        }
        // 难度
        $ql = intval($ql);
        if (!in_array($ql, array_keys(self::QUESTION_LEVELS))) {
            $ql = 0;
        }

        // 根据以上参数查询问题
        $sort = new Sort([
            'defaultOrder' => [
                'created_at' => SORT_ASC,
                'level' => SORT_ASC,
            ],
            'attributes' => [
                'created_at' => [
                    'label' => '上载日期',
                    'default' => SORT_DESC,
                ],
                'level' => ['label' => '试题难度'],
            ],
        ]);


        if ($t === BskCategoryOther::CATEGORY_TYPE_CHAPTER) { // 按章节检索试题
            $query = BskQuestion::find()
                ->andWhere(['chapter_id' => $c]);
        } else { // 按考点检索试题
            $relTable = BskQuestionPoint::tableName();
            $query = BskQuestion::find()
                ->innerJoin($relTable, $relTable . '.question_id=' . BskQuestion::tableName() . '.id')
                ->andWhere([$relTable . '.status' => BskQuestionPoint::STATUS_ACTIVE])
                ->andWhere([$relTable . '.point_id' => $c]);
        }
        if ($qt) {
            $query->andWhere(['type' => $qt]);
        }
        if ($ql) {
            $query->andWhere($ql === 1 ? 'level < 30' : ($ql === 2 ? ['between', 'level', 30, 70] : 'level > 70'));
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $questions = $query
                    ->orderBy($sort->orders)
                    ->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();

        // 返回数据到页面
        return $this->render('category', [
            'req' => ['g' => $g, 's' => $s, 't' => $t, 'l' => $l, 'm' => $m, 'c' => $c, 'qt' => $qt, 'ql' => $ql],
            'gradeSubjects' => $gradeSubjects,
            'curGradeSubjectName' => $gradeSubjects['gradeMap'][$g].$gradeSubjects['subjectMap'][$s],

            'syllabus' => $syllabus,
            'curSyllabusName' => $syllabusMap[$l],

            'semesters' => $semesters,
            'curSemesterName' => $semesterMap[$m],

            'extraCategories' => $extraCategories ? ArrayHelper::toArray($extraCategories) : null,

            'sort' => $sort,
            'pages' => $pages,
            'questions' => $questions,

            'searchTypes' => self::SEARCH_TYPES,
            'questionTypes' => self::QUESTION_TYPES,
            'questionLevels' => self::QUESTION_LEVELS,
        ]);
    }
}

