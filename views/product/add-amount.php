<?php

use kartik\form\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\PurchaseHistory $model */
/** @var ActiveForm $form */
//$this->title = "Add Amount - " . $price->product->name;
//$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $price->product->name, 'url' => ['view', 'id' => $price->product->id]];
//$this->params['breadcrumbs'][] = 'Add Amount';
?>
<div class="row">
    <div class="col-6 offset-3">

        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'amount') ?>
                <?= $form->field($model, 'purchase_price') ?>
                <?= $form->field($model, 'sell_price') ?>

                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    </div>
</div><!-- product-add-amount -->
