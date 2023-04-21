<?php
/** @var yii\web\View $this */

use app\components\tools\ChartDataProvider;

$data = ChartDataProvider::productAllAmount();
?>
    <div class="card">
        <div class="card-header">
            <p class="card-subtitle">All order amount</p>
            <h3 class="card-title"><?= $data['all_order_amount'] ?></h3>
        </div>
        <div class="card-body">
            <div id="order-amount-chart"></div>
        </div>
    </div>
<?php

$js = <<<JS
    var options = {
          series: {$data['order_amount']},
          chart: {
            type: 'donut',
            height: 300,
            width: '100%'
        },
        labels:{$data['name']},
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

        var chart = new ApexCharts(document.querySelector("#order-amount-chart"), options);
        chart.render();
JS;

$this->registerJs($js);
