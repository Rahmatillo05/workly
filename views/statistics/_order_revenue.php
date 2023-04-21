<?php
/** @var yii\web\View $this */

use app\components\tools\ChartDataProvider;
use app\components\widgets\NumberFormatter;
$data = ChartDataProvider::productAllAmount();
?>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">The money brought by the products</h5>
            <p class="card-subtitle">By net price: <b><?= NumberFormatter::letterFormat($data['order_net_price_all']) ?> $</b></p>
            <p class="card-subtitle">By with discount: <b><?= NumberFormatter::letterFormat($data['order_with_discount_all']) ?> $</b></p>
        </div>
        <div class="card-body">
            <div id="order-revenue-chart"></div>
        </div>
    </div>
<?php

$js = <<<JS
var options = {
          series: [{
              name:"Net price",
              data: {$data['order_net_price']}
        }, {
              name:"With discount",
              data: {$data['order_with_discount']}
        }],
          chart: {
          type: 'bar',
          height: 'auto'
        },
        plotOptions: {
          bar: {
            horizontal: false,
            dataLabels: {
              position: 'top',
            },
          }
        },
        dataLabels: {
          enabled: true,
          offsetX: -6,
          style: {
            fontSize: '12px',
            colors: ['#fff']
          }
        },
        stroke: {
          show: true,
          width: 1,
          colors: ['#fff']
        },
        tooltip: {
          shared: true,
          intersect: false
        },
        xaxis: {
          categories: {$data['name']},
        },
        };
var chart = new ApexCharts(document.querySelector("#order-revenue-chart"), options);
        chart.render();
JS;

$this->registerJs($js);
