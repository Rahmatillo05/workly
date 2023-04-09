<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/** @var yii\web\View $this */
/** @var common\models\Selling $model */
/** @var ActiveForm $form */
?>
<div class="site-_order_form">

    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['site/order']),
        'options' => [
            'id' => 'sell-form'
        ]
    ]); ?>

    <?= $form->field($model, 'product_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->productList, 'id', 'name', 'category.name'),
        'options' => [
            'placeholder' => 'Select a value...'
        ]
    ]) ?>
    <label class="form-group">
        Min sell price $
        <input type="text" id="mix-price" readonly class="form-control">
    </label>
    <?= $form->field($model, 'sell_amount') ?>
    <label class="form-group">
        All sum $
        <input type="text" id="all_summ" readonly class="form-control">
    </label>
    <?= $form->field($model, 'sell_price') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'order-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-_order_form -->