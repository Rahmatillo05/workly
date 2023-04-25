<?php


/** @var yii\web\View $this */

/** @var yii\data\ActiveDataProvider $statistics */

use app\models\OrderSorting;

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

    <div class="col-12 my-3">
        <?= $this->render('_order_sorting', ['model' => new OrderSorting()]) ?>
    </div>
    <div class="col-12 my-3">
        <?= $this->render('_statistics_table', compact('statistics')) ?>
    </div>
    <div class="col-12 mb-3">
        <?= $this->render('_statistics_chart') ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_product_amount') ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_order_amount') ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_order_revenue') ?>
    </div>
</div>

