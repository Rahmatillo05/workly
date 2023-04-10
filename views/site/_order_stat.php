<?php

use app\components\widgets\NumberFormatter;

/**
 * @var \yii\web\View $this
 * @var \app\models\Order $orders
 */

?>
<div class="card h-100">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
            <h5 class="m-0 me-2">Order Statistics</h5>
            <small class="text-muted"><?= NumberFormatter::letterFormat($orders->allOrderSum) ?> Total Sales</small>
        </div>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex flex-column align-items-center gap-1">
                <h2 class="mb-2"><?= NumberFormatter::letterFormat($orders->totalOrder) ?></h2>
                <span>Total Order Products</span>
            </div>
            <div id="orderStatistics"></div>
        </div>
        <ul class="p-0 m-0">
            <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"
                            ><i class="bx bx-mobile-alt"></i
                                ></span>
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
                            <span class="avatar-initial rounded bg-label-secondary"
                            ><i class="bx bx-football"></i
                                ></span>
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
let cardColor, headingColor, axisColor, shadeColor, borderColor;

  cardColor = config.colors.white;
  headingColor = config.colors.headingColor;
  axisColor = config.colors.axisColor;
  borderColor = config.colors.borderColor;
  const chartOrderStatistics = document.querySelector('#orderStatistics'),
    orderChartConfig = {
      chart: {
        height: 165,
        width: 130,
        type: 'donut'
      },
      labels: ['Electronic', 'Sports', 'Decor', 'Fashion'],
      series: [85, 15, 50, 50],
      colors: [config.colors.primary, config.colors.secondary, config.colors.info, config.colors.success],
      stroke: {
        width: 5,
        colors: cardColor
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val);
        }
      },
      legend: {
        show: false
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15
        }
      },
      plotOptions: {
        pie: {
          donut: {
            size: '75%',
            labels: {
              show: true,
              value: {
                fontSize: '1.5rem',
                fontFamily: 'Public Sans',
                color: headingColor,
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val);
                }
              },
              name: {
                offsetY: 20,
                fontFamily: 'Public Sans'
              },
              total: {
                show: false
              }
            }
          }
        }
      }
    };
  if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
    const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
    statisticsChart.render();
  }
JS;

$this->registerJs($js);
?>