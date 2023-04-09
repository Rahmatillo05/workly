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
        'action' => Url::toRoute(['product/create'])
    ]); ?>


    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>



    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>
    <?= $form->field($model, 'category_id')->hiddenInput(['value' => $category->id])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>