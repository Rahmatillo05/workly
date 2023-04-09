<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendor/fonts/boxicons.css',
        'vendor/css/core.css',
        'vendor/css/theme-default.css',
        'css/demo.css',
        'vendor/libs/perfect-scrollbar/perfect-scrollbar.css',
        'vendor/css/pages/page-auth.css',
        'css/nice-select.css',
    ];
    public $js = [
        // 'vendor/libs/jquery/jquery.js',
        'vendor/libs/popper/popper.js',
        'vendor/js/bootstrap.js',
        'vendor/libs/perfect-scrollbar/perfect-scrollbar.js',
        'vendor/js/menu.js',
        'vendor/libs/apex-charts/apexcharts.js',
        'js/main.js',
        'js/dashboards-analytics.js',
        'js/extended-ui-perfect-scrollbar.js',
        'js/jquery.nice-select.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
