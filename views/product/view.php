<?php

use app\components\tools\ChartDataProvider;
use app\components\widgets\Chart;
use app\models\PurchaseHistory;
use yii\helpers\Html;
use app\models\Product;
use yii\widgets\DetailView;
use app\components\widgets\PriceFormatter;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$data = ChartDataProvider::productPurchaseHistory($model->id, $model->name);
?>
<div class="row">
    <div class="col-6">
        <div class="card">

            <div class="card-header">
                <h1><?= Html::encode($this->title) ?></h1>

                <p>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>

            <div class="card-body">
                <?= DetailView::widget([
                    'options' => [
                        'class' => 'table table-bordered'
                    ],
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [
                            'attribute' => 'category_id',
                            'value' => $model->category->name
                        ],
                        'name',
                        'description:ntext',
                        [
                            'attribute' => 'amount',
                            'value' => function (Product $model) {
                                return round($model->remaining, 1);
                            },
                            'label' => 'Amount'
                        ],
                        [
                            'attribute' => 'purchase_price',
                            'value' => function (Product $model) {
                                return round($model->purchase_price, 1) . " $";
                            },
                            'label' => 'Purchase price'
                        ],
                        [
                            'attribute' => 'last_sell_price',
                            'value' => function (Product $model) {
                                return round($model->sell_price, 1) . " $";
                            },
                            'label' => 'Sell price'
                        ],
                        [
                            'attribute' => 'last_discount',
                            'value' => function (Product $model) {
                                $discount_price = PriceFormatter::calculateDiscountSum($model->sell_price, $model->discount);
                                return Html::tag('span', "{$discount_price} $ ({$model->discount}%)", ['class' => 'badge bg-label-info']);
                            },
                            'label' => 'Discount price',
                            'format' => 'html'
                        ],
                        'created_at:datetime',
                        'updated_at:datetime',
                    ],
                ]) ?>
            </div>

        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="fw-semibold">Order Statistics</h3>
                        <?= $this->render('_order_chart', ['orders' => $model]) ?>
                    </div>
                    <div class="card-body">
                        <div class="accordion mt-3" id="accordionExample">
                            <? //= $this->render('_order_view', ['orders' => $model->orders]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-header ">
                        <h3 class="fw-semibold">Purchase history</h3>
                        <table class="table table-bordered">
                            <tr>
                                <th><strong>Total arrived:</strong></th>
                                <td><span class="badge bg-info"><?= $model->amount->came ?></span></td>
                            </tr>
                            <tr>
                                <th><strong>Total sold:</strong></th>
                                <td><span class="badge bg-success"><?= $model->amount->sold ?></span></td>
                            </tr>
                            <tr>
                                <th><strong>Remaining:</strong></th>
                                <td><span class="badge bg-primary"><?= $model->remaining ?></span></td>
                            </tr>
                            <tr>
                                <th><strong>Total money spent:</strong></th>
                                <td><span class="badge bg-danger">$ <?= $model->totalSpentSum ?></span></td>
                            </tr>
                            <tr>
                                <th><strong>The sum of the remaining product:</strong></th>
                                <td><span class="badge bg-primary">$ <?= $model->totalRemainingSum ?></span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="accordion mt-3" id="purchaseAccordion">
                            <?= $this->render('_purchase_history', [
                                'history' => PurchaseHistory::find()->where(['product_id' => $model->id])->all()
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-body mt-5">
                        <?= $this->render('_purchase_history_chart', compact('data')) ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

