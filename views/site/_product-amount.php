<?php

use app\components\tools\ChartDataProvider;

$data = ChartDataProvider::productAmountByCategory();
?>

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                        <h5 class="text-nowrap mb-2">Product amount by categories</h5>
                    </div>
                    <div class="mt-sm-auto">
                        <h3 class="mb-0"><?= $data['all_amount'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <div id="productAmount"></div>
            </div>
            <ul class="p-0 mt-1">
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Electronic</h6>
                            <small class="text-muted">Mobile, Earbuds, TV</small>
                        </div>
                        <div class="user-progress">
                            <small class="fw-semibold">82.5k</small>
                        </div>
                    </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Fashion</h6>
                            <small class="text-muted">T-shirt, Jeans, Shoes</small>
                        </div>
                        <div class="user-progress">
                            <small class="fw-semibold">23.8k</small>
                        </div>
                    </div>
                </li>
                <li class="d-flex mb-4 pb-1">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Decor</h6>
                            <small class="text-muted">Fine Art, Dining</small>
                        </div>
                        <div class="user-progress">
                            <small class="fw-semibold">849k</small>
                        </div>
                    </div>
                </li>
                <li class="d-flex">
                    <div class="avatar flex-shrink-0 me-3">
                        <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-football"></i></span>
                    </div>
                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                        <div class="me-2">
                            <h6 class="mb-0">Sports</h6>
                            <small class="text-muted">Football, Cricket Kit</small>
                        </div>
                        <div class="user-progress">
                            <small class="fw-semibold">99</small>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

<?php

$js = <<<JS
        var options = {
          series: {$data['series']},
          chart: {
          width: 400,
          type: 'pie',
        },
        labels: {$data['labels']},
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#productAmount"), options);
        chart.render();
JS;

$this->registerJs($js);
