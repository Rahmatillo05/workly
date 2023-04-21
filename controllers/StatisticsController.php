<?php

namespace app\controllers;

use app\models\Statistics;
use Yii;
use yii\data\ActiveDataProvider;

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
}