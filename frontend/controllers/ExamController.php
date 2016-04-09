<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\models\BskQuestion;
use common\models\BskExam;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ExamController extends Controller
{

    /**
     *
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

