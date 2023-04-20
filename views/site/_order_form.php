<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var \app\models\Order $model */
/** @var ActiveForm $form */
?>
<div class="site-_order_form">

    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['site/order']),
        'options' => [
            'id' => 'sell-form'
        ],
        'type' => ActiveForm::TYPE_VERTICAL
    ]); ?>
    <?= $form->field($model, 'product_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->productList, 'id', 'name', 'category.name'),
        'options' => [
            'placeholder' => 'Select a product...'
        ]
    ]) ?>

    <div class="row">
        <div class="col-12 mb-3">
            <b id="discount_percent"></b>
        </div>
        <div class="col-6 mb-2">
            <label>
                Each product price $
                <input type="text" class="form-control" id="each_price" readonly>
            </label>
        </div>
        <div class="col-6 mb-2">
            <label>
                Product price with discount
                <input type="text" class="form-control" id="discount_price" readonly>
            </label>
        </div>
        <div class="col-12">
            <?= $form->field($model, 'amount') ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'sell_price')->textInput(['readonly' => 'readonly']) ?>
        </div>
        <div class="col-6">
            <?= $form->field($model, 'discount_price')->textInput(['readonly' => 'readonly']) ?>
        </div>
    </div>

    <div class="form-group ">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'order-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-_order_form -->