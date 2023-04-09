<?php

use common\components\widgets\PriceFormatter;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap5\Modal;
use common\models\Product;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">
    <div class="card">
        <div class="card-header pb-0">
            <h2><?= Html::encode($this->title) ?></h2>

            <p>
                <?php Modal::begin([
                    'title' => '<h2>Create Product</h2>',
                    'toggleButton' => ['label' => 'Create product', 'class' => 'btn btn-success'],
                ]);
                echo $this->render('_form', ['model' => new Product()]);
                Modal::end(); ?>
            </p>
        </div>

        <div class="card-body table-responsive text-nowrap pt-1">
            <?php $form = ActiveForm::begin([
                'action' => Url::toRoute(['product/multiple-update'])
            ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => [
                    'class' => 'table'
                ],
                'layout' => "{summary}\n{items}",
                'columns' => [
                    [
                        'class' => CheckboxColumn::class,
                        'cssClass' => 'form-check-input'
                    ],
                    'id',
                    [
                        'attribute' => 'category_id',
                        'value' => 'category.name',
                    ],
                    'name',
                    [
                        'attribute' => 'last_purchase_price',
                        'label' => 'Purchase price',
                        'value' => function (Product $model) {
                            return PriceFormatter::productPriceDifference($model);
                        },
                        'format' => 'html'
                    ],
                    [
                        'attribute' => 'last_sell_price',
                        'value' => function (Product $model) {
                            return round($model->last_sell_price, 1) . " $";
                        },
                        'label' => 'Sell price'
                    ],
                    [
                        'attribute' => 'last_discount',
                        'value' => function (Product $model) {
                            $discount_price = PriceFormatter::calculateDiscountSum($model->last_sell_price, $model->last_discount);
                            return Html::tag('span', "{$discount_price} $ ({$model->last_discount}%)", ['class' => 'badge bg-label-info']);
                        },
                        'label' => 'Discount price',
                        'format' => 'html'
                    ],
                    'created_at:date',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        }
                    ],
                ],
            ]); ?>
            <div class="demo-inline-spacing d-flex justify-content-left align-items-center">
                <i class="">With selected:</i>
                 <?= Html::submitButton('Change Price and Discount', ['class' => 'btn btn-sm btn-outline-info mt-2']) ?></div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>