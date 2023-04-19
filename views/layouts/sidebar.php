<?php

use yii\helpers\Url;
use app\components\widgets\Sidebar;

echo Sidebar::widget([
    'menuItems' => [
        ['url' => Url::to(['site/index']), 'label' => 'Dashboard', 'icon' => 'tf-icons bx bx-home-circle'],
        ['url' => Url::to(['category/index']), 'label' => 'Categories', 'icon' => 'tf-icons bx bx-server'],
        ['url' => Url::to(['product/index']), 'label' => 'Products', 'icon' => 'tf-icons bx bx-shopping-bag'],
        ['url' => Url::to(['statistics/index']), 'label' => 'Statistics', 'icon' => 'tf-icons bx bx-line-chart'],
    ]
]);
