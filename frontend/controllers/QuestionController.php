<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use common\models\BskQuestion;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class QuestionController extends Controller
{

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

}

