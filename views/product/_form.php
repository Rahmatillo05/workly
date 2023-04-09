<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>
<div class="p-2">

    <?php $form = ActiveForm::begin([
        'action' => isset($update) ? Url::toRoute(['product/update', 'id' => $model->id]) : Url::toRoute(['product/create'])
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($model->categoryList, 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remaining_amount')->textInput()->label('Product amount') ?>

    <?= $form->field($model, 'last_purchase_price')->textInput()->label('Purchase Price $') ?>

    <?= $form->field($model, 'last_sell_price')->textInput()->label('Sell Price $') ?>
    <?= $form->field($model, 'last_discount')->textInput()->label('Discount %') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>