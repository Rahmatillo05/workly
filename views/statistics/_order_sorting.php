<?php

use kartik\date\DatePicker;
use kartik\form\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="card">
    <h3 class="card-header">View by date</h3>
    <div class="card-body">
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'type' => ActiveForm::TYPE_FLOATING,
            'action' => Url::toRoute(['statistics/sorting'])
        ]); ?>
        <div class="row">

            <div class="col-md-6">
                <?= $form->field($model, 'start_time')->widget(DatePicker::class, [
                    'options' => ['placeholder' => 'Start time...'],
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
                    'options' => ['placeholder' => 'End time...'],
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
                <div class="form-group d-flex justify-content-between align-items-center">
                    <?= Html::submitButton('Sorting', ['class' => 'btn btn-primary']); ?>
                </div>
                <?php
                ActiveForm::end();
                ?>
            </div>
        </div>
    </div>
</div>
