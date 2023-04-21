<?php


/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $statistics */

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-4">
        <?= $this->render('_product_amount') ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_order_amount')?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_order_revenue')?>
    </div>
    <div class="col-12 my-3">
        <?= $this->render('_statistics_table', compact('statistics')) ?>
    </div>
    <col-12>
        <?= $this->render('_statistics_chart') ?>
    </col-12>

</div>

