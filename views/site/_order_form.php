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
    <?= $form->field($model, 'category_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->productList, 'id', 'name'),
        'options' => [
            'placeholder' => 'Select a category...'
        ]
    ]) ?>
    <?= $form->field($model, 'product_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->productList, 'id', 'name', 'category.name'),
        'options' => [
            'placeholder' => 'Select a product...'
        ]
    ]) ?>
    <label class="form-group">
        Min sell price with discount $
        <input type="text" id="mix-price" readonly class="form-control">
    </label>
    <p id="discount"></p>
    <?= $form->field($model, 'amount') ?>
    <label class="form-group">
        All sum $
        <input type="text" id="all_summ" readonly class="form-control">
    </label>
    <?= $form->field($model, 'sell_price') ?>

    <div class="form-group ">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id' => 'order-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-_order_form -->