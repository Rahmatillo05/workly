<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\bootstrap5\ActiveForm $form */

?>
<div class="p-2">

    <?php $form = ActiveForm::begin([
        'action' =>  Url::toRoute(['product/create'])
    ]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($model->categoryList, 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'has_came_amount')->textInput()->label('Product amount') ?>

    <?= $form->field($model, 'purchase_price')->textInput()->label('Purchase Price $') ?>

    <?= $form->field($model, 'sell_price')->textInput()->label('Sell Price $') ?>
    <?= $form->field($model, 'discount')->textInput()->label('Discount %') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>