<?php

use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
$sorting_date = Yii::$app->request->get('OrderSorting') ?? [
    'start_time' => date('d-m-Y', Yii::$app->user->identity->created_at),
    'end_time' => date('d-m-Y', strtotime('yesterday'))
];

?>
<div class="card">
    <h3 class="card-header">View by date</h3>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'type' => ActiveForm::TYPE_FLOATING,
        ]); ?>
        <div class="row">

            <div class="col-md-6">
                <?= $form->field($model, 'start_time')->widget(DatePicker::class, [
                    'options' => [
                        'placeholder' => 'Start time...',
                        'value'  => $sorting_date['start_time']
                    ],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                        'autoclose' => true,
                    ],
                    'pickerIcon' => "<i class='bx bxs-calendar'></i>",
                    'removeIcon' => "<i class='bx bx-reset text-danger'></i>"
                ])->label(false); ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'end_time')->widget(DatePicker::class, [
                    'options' => [
                        'placeholder' => 'End time...',
                        'value' => $sorting_date['end_time']
                    ],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'todayHighlight' => true,
                        'autoclose' => true,
                    ],
                    'pickerIcon' => "<i class='bx bxs-calendar'></i>",
                    'removeIcon' => "<i class='bx bx-reset text-danger'></i>"
                ])->label(false); ?>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <?= Html::submitButton('Sorting', ['class' => 'btn btn-primary']); ?>
                    <?= Html::a('All', ['index'], ['class' => 'btn btn-outline-info']) ?>
                </div>
                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>
