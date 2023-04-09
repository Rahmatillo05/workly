<?php

use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;


$form = ActiveForm::begin([
    'method' => 'get',
    'type' => ActiveForm::TYPE_HORIZONTAL
]);

echo $form->field($model, 'start_time')->widget(DatePicker::class, [
    'options' => ['placeholder' => 'Start time...'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose'=>true,
    ],
    'pickerIcon' => "<i class='bx bxs-calendar'></i>",
    'removeIcon' => "<i class='bx bx-reset text-danger'></i>"
])->label(false);

echo $form->field($model, 'end_time')->widget(DatePicker::class, [
    'options' => ['placeholder' => 'End time...'],
    'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'todayHighlight' => true,
        'autoclose'=>true,
    ],
    'pickerIcon' => "<i class='bx bxs-calendar'></i>",
    'removeIcon' => "<i class='bx bx-reset text-danger'></i>"
])->label(false);

echo Html::submitButton('Sorting', ['class' => 'btn btn-primary']);

ActiveForm::end();
?>
