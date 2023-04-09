<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ProductAmountHistory $model */
/** @var app\models\ProductPurchaseHistory $price */
/** @var ActiveForm $form */
$this->title = "Add Amount - " . $price->product->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $price->product->name, 'url' => ['view', 'id' => $price->product->id]];
$this->params['breadcrumbs'][] = 'Add Amount';
?>
<div class="row">
    <div class="col-6 offset-3">

        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'has_came_amount') ?>
                <?= $form->field($price, 'purchase_price') ?>
                <?= $form->field($price, 'sell_price') ?>
                <?= $form->field($price, 'discount') ?>
                <?= $form->field($model, 'product_id')->hiddenInput()->label(false) ?>
                <?= $form->field($price, 'product_id')->hiddenInput()->label(false) ?>
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div><!-- product-add-amount -->
