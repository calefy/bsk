<?php

namespace backend\controllers;

use Yii;
use common\models\BskCategory;
use yii\web\Controller;

class BskCategoryController extends Controller {
    public function actionIndex() {
        return $this->render('index');
    }
}
