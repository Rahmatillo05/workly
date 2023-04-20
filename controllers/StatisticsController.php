<?php

namespace app\controllers;

use app\models\Statistics;
use Yii;

class StatisticsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $model = new Statistics();
        if ($model->isSave()) {
            Yii::$app->session->setFlash('success', "Staistika qiymatlari olindi");
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', "Staistika qiymatlari olinmadi");
        return $this->redirect(['index']);
    }
}