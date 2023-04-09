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
                        <small class="text-success fw-semibold">Sold today: <?= $order->todaySoldAmount() ?? 0 ?></small>
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
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">New Order</h5>
                    <small class="text-muted">42.82k Total Sales</small>
                </div>
            </div>
            <div class="card-body">
                <?= $this->render('_order_form', ['model' => $order]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Orders history</h5>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">Paypal</small>
                                <h6 class="mb-0">Send money</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">+82.6</h6>
                                <span class="text-muted">USD</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="content-backdrop fade"></div>