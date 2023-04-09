<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var backend\models\ProductDiscount $model */
/** @var ActiveForm $form */
?>
<div class="category_products_discount">

    <?php $form = ActiveForm::begin([
        'action' => Url::toRoute(['category/set-discount'])
    ]); ?>

    <?= $form->field($model, 'discount') ?>

    <?= $form->field($model, 'category_id')->hiddenInput(['value' => $category->id])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- category-_products_discount -->