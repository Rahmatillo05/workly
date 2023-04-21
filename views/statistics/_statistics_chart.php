<?php

use app\components\tools\ChartDataProvider;

$data = ChartDataProvider::statisticsData();

?>

<div class="card">
    <div class="card-header">
        <h3>Statistics with chart</h3>
    </div>
    <div class="card-body">
        <div id="statistics-chart"></div>
    </div>
</div>

<?php

$js = <<<JS
var options = {
          series: [{
          name: 'Sales',
          data: {$data['sales']}
        }, {
          name: 'Product cost',
          data: {$data['product_sum']}
        }, {
          name: 'Net profit',
          data: {$data['net_profit']}
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: {$data['date']},
        },
      
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#statistics-chart"), options);
        chart.render();
JS;

$this->registerJs($js);
