<?php
/** @var yii\web\View $this */
/** @var app\models\Product $orders */
?>
<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                <div class="card-title">
                    <span class="badge bg-label-warning rounded-pill">This month</span>
                </div>
                <div class="mt-sm-auto">
                    <h3 class="mb-0"><?//= $orders->getOrdersAmount() ?></h3>
                </div>
            </div>
            <div id="orderStatChart"></div>
        </div>
    </div>
    <div class="card-footer">

    </div>
</div>


<?php
$js = <<<JS

const profileReportChartEl = document.querySelector('#orderStatChart'),
        profileReportChartConfig = {
            chart: {
                height: 80,
                // width: 175,
                type: 'line',
                toolbar: {
                    show: false
                },
                dropShadow: {
                    enabled: true,
                    top: 10,
                    left: 5,
                    blur: 3,
                    color: config.colors.warning,
                    opacity: 0.15
                },
                sparkline: {
                    enabled: true
                }
            },
            grid: {
                show: false,
                padding: {
                    right: 8
                }
            },
            colors: [config.colors.warning],
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 5,
                curve: 'smooth'
            },
            series: [
                {
                    name: "Amount",
                    data: []
                }
            ],
            xaxis: {
                show: false,
                lines: {
                    show: false
                },
                labels: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                show: false
            }
        };
    if (typeof profileReportChartEl !== undefined && profileReportChartEl !== null) {
        const profileReportChart = new ApexCharts(profileReportChartEl, profileReportChartConfig);
        profileReportChart.render();
    }
JS;
//$this->registerJs($js);
?>

