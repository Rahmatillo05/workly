<?php

namespace app\controllers;

use app\models\OrderSorting;
use app\models\Statistics;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\VarDumper;

class StatisticsController extends BaseController
{
    public function actionIndex()
    {
        $statistics = new ActiveDataProvider([
            'query'  => Statistics::find()->orderBy(['id'=>SORT_DESC]),
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
//        $order = new OrderSorting();
//        $order->start_time = date('01-m-Y');
//
//        $order->end_time = date('d-m-Y', strtotime('yesterday'));
        return $this->render('index', compact('statistics'));
    }

    public function actionStatCreate()
    {
        $model = new Statistics();
        if ($model->isSave()) {
            Yii::$app->session->setFlash('success', "Staistika qiymatlari olindi");
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', "Staistika qiymatlari olinmadi");
        return $this->redirect(['index']);
    }

    public function actionSorting()
    {
        return $this->render('sorting');
    }
}