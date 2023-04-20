<?php

namespace app\controllers;

class StatisticsController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}