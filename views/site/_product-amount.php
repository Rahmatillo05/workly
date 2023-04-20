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
