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
        'action' => Url::toRoute(['site/order'])
    ]); ?>

    <?= $form->field($model, 'product_id')->widget(Select2::class, [
        'data' => ArrayHelper::map($model->productList, 'id', 'name', 'category.name'),
        'options' => ['placeholder' => 'Select a value...']
    ]) ?>
    <?= $form->field($model, 'sell_amount') ?>
    <?= $form->field($model, 'sell_price') ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-_order_form -->