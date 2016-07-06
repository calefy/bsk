<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

use common\models\BskQuestion;
use common\models\BskExam;

/**
 */
class SearchController extends Controller
{

    const SEARCH_TYPE_QUESTION = 1; // 搜索试题类型
    const SEARCH_TYPE_EXAM = 2; // 搜索试卷类型

    /**
     * 搜索
     * @param $type 搜索分类（1-试题， 2- 试卷）
     * @param $text 搜索文本内容
     */
    public function actionIndex($type = self::SEARCH_TYPE_QUESTION, $text = null) {
        if (!$text || !trim($text)) {
            $this->redirect('/');
            return;
        }

        $text = trim($text);
        if ($type == self::SEARCH_TYPE_EXAM) { // 搜索试卷
            $query = BskExam::find();
            $defaultOrder = [
                'created_at' => SORT_DESC,
                'category_id' => SORT_DESC,
            ];
        } else { // 搜索试题
            $query = BskQuestion::find();
            $defaultOrder = [
                'created_at' => SORT_DESC,
                'chapter_id' => SORT_DESC,
            ];
        }
        $query->andWhere(['like', 'title', $text]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => $defaultOrder,
            ]
        ]);

        return $this->render('index', [
            'type' => $type,
            'provider' => $provider,
        ]);
    }
}
