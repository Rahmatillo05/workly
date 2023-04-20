<?php

use app\components\tools\ChartDataProvider;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var \app\models\Order[] $orders
 * @var \app\models\Order $order
 */

$this->title = 'Workly task';

$data = ChartDataProvider::dailyStatistics();

?>

<div class="row">
    <div class="col-lg-8 mb-4 order-0">
        <?= $this->render('_motivation') ?>
    </div>
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="<?= Url::base() ?>/img/icons/unicons/chart-success.png"
                                    alt="chart success"
                                    class="rounded"
                                />
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Profit</span>
                        <h3 class="card-title mb-2">$<?= $data['profit'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="<?= Url::base() ?>/img/icons/unicons/wallet-info.png"
                                    alt="Credit Card"
                                    class="rounded"
                                />
                            </div>

                        </div>
                        <span class="fw-semibold d-block mb-1">Sales</span>
                        <h3 class="card-title text-nowrap mb-1">$<?= $data['sales'] ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order -->
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="row row-bordered g-0">
                <div class="col-md-6">
                    <h4 class="card-header m-0 me-2 pb-3">New Order</h4>
                    <div class="card-body">
                        <?= $this->render('_order_form', ['model' => $order]) ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body p-2">
                        <div class="text-center">
                            <span class="badge badge-pill bg-label-info ">
                                Today
                            </span>
                        </div>
                        <div class="text-center fw-semibold pt-3 mb-2">Today's results</div>
                        <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                            <div class="d-flex">
                                <div class="me-2">
                                <span class="badge bg-label-primary p-2"><i
                                        class="bx bx-dollar text-primary"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>Net price</small>
                                    <h6 class="mb-0">$<?= $data['net_price'] ?></h6>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="me-2">
                                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>With discount</small>
                                    <h6 class="mb-0">$<?= $data['sales'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="text-center fw-semibold pt-3 mb-2">Today's order history</div>
                        <div class="ps ps--active-y p-0" style="height: 250px" id="vertical-example">
                            <?= $this->render('_order_view', compact('orders')) ?>
                            <div class="ps__rail-x" style="left: 0px; bottom: -1080px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="ps__rail-y" style="top: 1080px; height: 232px; right: 0px;">
                                <div class="ps__thumb-y" tabindex="0" style="top: 191px; height: 40px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Order -->

    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
            <!-- </div>
<div class="row"> -->
            <div class="col-12 mb-4">
                <?= $this->render('_product-amount') ?>
            </div>
        </div>
    </div>
</div>


<div class="content-backdrop fade"></div>