<?php

use yii\helpers\Url;
use yii\helpers\Html;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \app\models\Category $category */
?>
<div class="p-2">

    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['product/create'])
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_came_amount')->textInput()->label('Product amount') ?>

    <?= $form->field($model, 'purchase_price')->textInput()->label('Purchase Price $') ?>

    <?= $form->field($model, 'sell_price')->textInput()->label('Sell Price $') ?>

    <?= $form->field($model, 'discount')->textInput()->label('Discount %') ?>


    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>
    <?= $form->field($model, 'category_id')->hiddenInput(['value' => $category->id])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>