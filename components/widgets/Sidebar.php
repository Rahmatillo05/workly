<?php

namespace app\components\widgets;

use Exception;
use yii\base\Widget;

class Sidebar extends Widget
{

    public array $menuItems;

    public function init()
    {
        parent::init();

        if (!is_array($this->menuItems)) {
            throw new Exception('Default value should be an array');
        }
    }

    public function run()
    {
        return $this->render('_sidebar_view', [
            'items' => $this->menuItems
        ]);
    }
}
