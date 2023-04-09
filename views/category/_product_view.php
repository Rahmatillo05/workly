<?php

use app\models\ProductDiscount;
use yii\helpers\Url;
use yii\bootstrap5\Modal;
use yii\widgets\ListView;
use app\models\Product;
use kartik\editable\Editable;
use yii\bootstrap5\LinkPager;

?>
<div class="col-8">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Category: <?= $category->name ?? '' ?></h4>
            <?php if ($category) : ?>
                <div class="d-flex justify-content-around align-items-center">
                    <?php Modal::begin([
                        'title' => '<h2>Create Product</h2>',
                        'toggleButton' => ['label' => 'Add product', 'class' => 'btn btn-success'],
                    ]);
                    echo $this->render('_product_form', ['model' => new Product(), 'category' => $category]);
                    Modal::end(); ?>
                    <?php Modal::begin([
                        'title' => '<h2>Set Discount</h2>',
                        'toggleButton' => ['label' => 'Set Disscount %', 'class' => 'btn btn-info'],
                    ]);
                    echo $this->render('_products_discount', ['model' => new ProductDiscount(), 'category' => $category]);
                    Modal::end(); ?>
                </div>
            <?php endif; ?>
            <?php if ($category) : ?>
                <div class="accordion mt-3 shadow-none" id="accordionExample">
                    <div class="card accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
                                About Category
                            </button>
                        </h2>
                        <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>Created time</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><?= Editable::widget([
                                                'name' => 'category_name',
                                                'value' => $category->name,
                                                'asPopover' => false,
                                                'format' => Editable::FORMAT_BUTTON,
                                                'editableButtonOptions' => [
                                                    'label' => "<i class='bx bx-edit-alt'></i>",
                                                ],
                                                'submitButton' => [
                                                    'icon' => "<i class='bx bx-check-circle' ></i>",
                                                    'class' => "kv-editable-submit btn btn-sm btn-info",
                                                ],
                                                'buttonsTemplate' => "{submit}",
                                                'options' => ['class' => 'form-control', 'prompt' => 'Category name'],
                                            ]);
                                            ?></td>
                                        <td><?= date('d-m-Y H:i', $category->created_at) ?></td>
                                        <td><a class="btn btn-sm btn-danger" href="<?= Url::to(['delete', 'id' => $category->id]) ?>" data-method="post"><i class='bx bxs-trash-alt'></i></a></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="card-body card-body">
            <h4 class="card-title">Product list</h4>
            <div class="ps ps--active-y" style="height: 400px" id="vertical-example2">
                <?= ListView::widget([
                    'dataProvider' => $productProvider,
                    'options' => ['class' => 'list-group list-group-flush'],
                    'itemView' => '_product_view_item',
                    'emptyText' => 'Products not found',
                    'layout' => "{items}"
                ]) ?>
                <div class="ps__rail-x" style="left: 0px; bottom: -1080px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 1080px; height: 232px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 191px; height: 40px;"></div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <?= LinkPager::widget([
                'pagination' => $productProvider->pagination
            ]) ?>
        </div>
    </div>
</div>