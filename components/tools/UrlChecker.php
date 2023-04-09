<?php

namespace app\components\tools;

use Yii;
use yii\base\Widget;

class UrlChecker extends Widget
{


    public function init()
    {
        parent::init();
    }


    public static function isActive($url)
    {
        $controllerID = Yii::$app->request->url;
        $urlSegments = $url;
        if($controllerID === $urlSegments){
            return "active";
        }
        return " ";
    }
}
