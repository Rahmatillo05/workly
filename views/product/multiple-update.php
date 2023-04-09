<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/**
 * @var \common\models\Product $products
 */
?>

<div class="row">
    <div class="col-10 offset-1">
        <div class="card">
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'action' => Url::toRoute(['product/multiple-update-save'])
                ]) ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Purchase Price</th>
                            <th>Sell Price</th>
                            <th>Discount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($products) : foreach ($products as $product) : ?>
                                <tr>
                                    <td><?= $product->product->name ?></td>
                                    <td class="d-none"><?= $form->field($product, 'id')->hiddenInput(['name' => "Product_{$product->id}[id]"])->label(false) ?></td>
                                    <td><?= $form->field($product, 'purchase_price')->textInput(['name' => "Product_{$product->id}[purchase_price] "])->label(false) ?></td>
                                    <td><?= $form->field($product, 'sell_price')->textInput(['name' => "Product_{$product->id}[sell_price] "])->label(false) ?></td>
                                    <td><?= $form->field($product, 'discount')->textInput(['name' => "Product_{$product->id}[discount] "])->label(false) ?></td>
                                </tr>
                        <?php endforeach;
                        endif;  ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <?= Html::submitButton("Save changes", ['class' => 'btn btn-outline-success']) ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>