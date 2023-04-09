<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use common\models\Product;
use yii\widgets\DetailView;
use common\components\widgets\PriceFormatter;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="row">
    <div class="col-8">
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
                        'remaining_amount',
                        [
                            'attribute' => 'last_purchase_price',
                            'label' => 'Purchase price',
                            'value' => function (Product $model) {
                                return PriceFormatter::productPriceDifference($model);
                            },
                            'format' => 'html'
                        ],
                        'last_sell_price',
                        [
                            'attribute' => 'last_discount',
                            'value' => function (Product $model) {
                                $discount_price = PriceFormatter::calculateDiscountSum($model->last_sell_price, $model->last_discount);
                                return Html::tag('span', "{$discount_price} $ ({$model->last_discount}%)", ['class' => 'badge bg-label-info']);
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
</div>