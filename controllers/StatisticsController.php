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
        $query = Statistics::find()->orderBy(['id' => SORT_DESC]);
        $request = $this->request;
        if ($sorting_date = $request->get('OrderSorting')) {
            $query->where([
                'between',
                'created_at',
                strtotime($sorting_date['start_time']),
                strtotime($sorting_date['end_time'])
            ]);
        }
        $statistics = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
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