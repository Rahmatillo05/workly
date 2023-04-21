<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $statistics */
?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <p class="card-subtitle">This data is taken every day at 00:00</p>
    </div>
    <div class="table-responsive text-nowrap">
        <?= GridView::widget([
            'dataProvider' => $statistics,
            'tableOptions' => [
                'class' => 'table',
            ],
            'layout' => "{items}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'income',
                'sales',
                'income_amount',
                'sales_amount',
                'discount_price',
                'product',
                'net_profit',
                'created_at:date',
            ]
        ]); ?>
    </div>
    <div class="card-footer">
        <?=
        LinkPager::widget([
            'pagination' => $statistics->pagination
        ])
        ?>
    </div>
</div>
