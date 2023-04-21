<?php
/** @var yii\web\View $this */

use app\components\tools\ChartDataProvider;

$data = ChartDataProvider::productAllAmount();
$all_amount = ChartDataProvider::productAmountByCategory()['all_amount'];
?>
    <div class="card">
        <div class="card-header">
            <p class="card-subtitle">Remaining product amount</p>
            <h3 class="card-title"><?= $all_amount ?></h3>
        </div>
        <div class="card-body">
            <div id="amount-chart"></div>
        </div>
    </div>
<?php

$js = <<<JS
var options = {
          series: [{
              name:"Amount",
          data: {$data['amount']}
        }],
          chart: {
          type: 'bar',
          height: 'auto'
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: false,
          }
        },
        colors: ['#16caf0'],
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: {$data['name']},
        }
        };

        var chart = new ApexCharts(document.querySelector("#amount-chart"), options);
        chart.render();
JS;

$this->registerJs($js);

