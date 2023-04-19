<?php

namespace app\components\widgets;

use yii\base\Widget;

class Chart extends Widget
{

    public static function lineChart(string $title, array $chartData): string
    {
        $series = $chartData['series'];
        $categories = $chartData['categories'];
        $options = [
            'series' => $series,
            'type' => 'line',
            'chartOptions' => [
                'height' => 500,
                'zoom' => [
                    'enabled' => false
                ],
                'toolbar' => [
                    'show' => false,
                ],
                'dataLabels' => [
                    'enabled' => false
                ],
                'stroke' => [
                    'curve' => 'straight'
                ],
                'title' => [
                    'text' => $title,
                    'align' => 'left'
                ],
                'grid' => [
                    'row' => [
                        'colors' => ['#f3f3f3', 'transparent'],
                        'opacity' => 0.5
                    ]
                ],
                'xaxis' => [
                    'categories' => $categories
                ]
            ]
        ];

    }

}