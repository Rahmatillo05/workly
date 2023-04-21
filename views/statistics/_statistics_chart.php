<?php
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
          name: 'SALES',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'SALES AMOUNT',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }, {
          name: 'NET PROFIT',
          data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
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
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#statistics-chart"), options);
        chart.render();
JS;

$this->registerJs($js);
