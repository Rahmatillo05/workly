<div id="history"></div>

<?php
$js = <<<JS
 let series = {$data['series']};
    var options = {
        series: series,
        chart: {
            height: 350,
            type: 'line',
            dropShadow: {
                enabled: true,
                color: '#000',
                top: 18,
                left: 7,
                blur: 10,
                opacity: 0.2
            },
            toolbar: {
                show: false
            },
            zoom: {
                type: 'x',
                enabled: true,
                autoScaleYaxis: true
            }
        },
        dataLabels: {
            enabled: true
        },
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: 'Purchase price history',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['#f3f3f3', 'transparent'],
                opacity: 0.5
            },
        },
        xaxis: {
            categories: {$data['categories']},
            title: {
                text: 'Date'
            }
        },
        yaxis: {
            title: {
                text: 'Purchase Price $'
            }
        },
    };

    var chart = new ApexCharts(document.querySelector("#history"), options);
    chart.render();
JS;

$this->registerJs($js);
