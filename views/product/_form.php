<?php

use kartik\select2\Select2;
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
        'action' =>  Url::toRoute(['product/update', 'id' => $model->id])
    ]); ?>

    <?= $form->field($model, 'category_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->categoryList, 'id', 'name', 'category.name')
    ])?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>