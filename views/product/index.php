<?php

use app\components\widgets\PriceFormatter;
use app\models\ProductCreateModel;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap5\Modal;
use app\models\Product;
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

            <div class="d-flex">
                <?php Modal::begin([
                    'title' => '<h2>Create Product</h2>',
                    'toggleButton' => ['label' => 'Create product', 'class' => 'btn btn-success'],
                ]);
                echo $this->render('_modal_form', ['model' => new ProductCreateModel()]);
                Modal::end(); ?>
            </div>
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
                        'cssClass' => 'form-check-input',
                        'checkboxOptions' => function (Product $model, $key, $index, $column) {
                            return ['value' => $model->id];
                        }
                    ],
                    'id',
                    [
                        'attribute' => 'category_id',
                        'value' => 'category.name',
                    ],
                    'name',
                    [
                        'attribute' => 'purchase_price',
                        'value' => function(Product $model){
                            $oldPrice = isset($model->purchaseHistories[1]) ? $model->purchaseHistories[1]->purchase_price : null;
                            return PriceFormatter::productPurchasePriceDifference($oldPrice, $model->purchase_price);
                        },
                        'format' => 'html'
                    ],
                    [
                        'attribute' => 'sell_price',
                        'value' => function(Product $model){
                            $oldPrice = isset($model->purchaseHistories[1]) ? $model->purchaseHistories[1]->sell_price : null;
                            return PriceFormatter::productSellPriceDifference($oldPrice, $model->sell_price);
                        },
                        'format' => 'html'
                    ],
                    [
                        'attribute' => 'discount',
                        'value' => function(Product $model){
                            $sum = PriceFormatter::calculateDiscountSum($model->sell_price, $model->discount);
                            return Html::tag('span', "$ $sum( {$model->discount} %)", ['class' => 'badge bg-warning']);
                        },
                        'format' => 'html'
                    ],
                    'remaining',
                    'updated_at:date',
                    [
                        'class' => ActionColumn::class,
                        'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                            return Url::toRoute([$action, 'id' => $model->id]);
                        },
                        'template' => ' {add-amount} {view} {update} {delete} ',
                        'buttons' => [
                            'add-amount' => function ($url, $model) {
                                return Html::a('<i class="btn btn-sm btn-success bx bx-plus"></i>',
                                    $url, [
                                        'title' => "Add Amound"
                                    ]);
                            },
                            'view' => function ($url, $model) {
                                return Html::a('<i class="btn btn-sm btn-info bx bx-show"></i>',
                                    $url, [
                                        'title' => "View"
                                    ]);
                            },
                            'update' => function ($url, $model) {
                                return Html::a('<i class="btn btn-sm btn-primary bx bx-edit"></i>',
                                    $url, [
                                        'title' => "Update"
                                    ]);
                            },
                            'delete' => function ($url, $model) {
                                return Html::a('<i class="btn btn-sm btn-danger bx bx-trash"></i>',
                                    $url, [
                                        'title' => "Delete",
                                        'data-method' => 'post'
                                    ]);
                            }
                        ]
                    ],
                ],
            ]); ?>
            <div class="demo-inline-spacing d-flex justify-content-left align-items-center">
                <i class="">With selected:</i>
                <?= Html::submitButton('Change Price and Discount', ['class' => 'btn btn-sm btn-outline-info mt-2']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>