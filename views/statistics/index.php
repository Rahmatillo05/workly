<?php

use app\models\Statistics;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $statistics */

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="card">

        <h3 class="card-header"><?= Html::encode($this->title) ?></h3>
        <div class="table-responsive text-nowrap">
            <?= GridView::widget([
                'dataProvider' => $statistics,
                'tableOptions' => [
                    'class' => 'table',
                ],
                'layout' => "{items}\n{pager}",
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
                ],
            ]); ?>
        </div>
    </div>
</div>

