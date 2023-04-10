<?php

use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\models\Order $order
 */

$this->title = 'Workly task';
?>


<div class="row">
    <div class="col-lg-6 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= Url::base() ?>/img/icons/unicons/chart-success.png" alt="chart success"
                                     class="rounded"/>
                            </div>

                        </div>
                        <span class="fw-semibold d-block">Total sales amount</span>
                        <h3 class="card-title mb-2  mt-3 mb-1"><?= $order::find()->sum('sell_price') ?? 0 ?> $</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= Url::base() ?>/img/icons/unicons/wallet-info.png" alt="Credit Card"
                                     class="rounded"/>
                            </div>

                        </div>
                        <span>Today's sales amount</span>
                        <h3 class="card-title text-nowrap mt-3 mb-1"><?= $order->todaySalesAmount() ?? 0 ?> $</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 col-lg-6 order-3 order-md-2">
        <div class="row">
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= Url::base() ?>/img/icons/unicons/cc-primary.png" alt="Credit Card"
                                     class="rounded"/>

                            </div>

                        </div>
                        <span class="d-block">The remaining products volume</span>
                        <h3 class="card-title text-nowrap mb-1"><?= $product_amount ?? 0 ?></h3>
                        <small class="text-success fw-semibold">Sold
                            today: <?= $order->todaySoldAmount() ?? 0 ?></small>
                    </div>
                </div>
            </div>
            <div class="col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="<?= Url::base() ?>/img/icons/unicons/paypal.png" alt="Credit Card"
                                     class="rounded"/>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-3">The amount spent on the product</span>
                        <h3 class="card-title mb-2"><?= $order->calculateTotalValue() ?> $</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-8 col-lg-6 col-xl-4 order-0 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-3">
                    <h5 class="m-0 me-2">New Order</h5>
                </div>
            </div>
            <div class="card-body">
                <?= $this->render('_order_form', ['model' => $order]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title m-0 me-2">Orders history</h5>
                <div class="mt-2">
                    <?= $this->render('_order_sorting', ['model' => $order_sorting]) ?>
                </div>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <div class="accordion mt-3" id="orderHistory">
                        <?= $this->render('_order_view', ['orders' => $order_sorting->orderSorting()]) ?>
                    </div>
                </ul>
            </div>
        </div>
    </div>


</div>


<div class="content-backdrop fade"></div>