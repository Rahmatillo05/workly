<?php

namespace app\components\tools;

use app\components\widgets\Chart;
use app\models\PurchaseHistory;
use yii\base\Widget;

class ChartDataProvider extends Widget
{

    public static function productPurchaseHistory($product_id, $product_name)
    {
        $history = PurchaseHistory::find()->where(['product_id' => $product_id])->all();
        if (!$history) {
            return [];
        }
        $data = [];
        $series['name'] = $product_name;
        $categories = [];
        foreach ($history as $item) {
            /**@var PurchaseHistory $item */
            $series['data'][] = (int)$item->purchase_price;
            $categories[] = date('H:i M-d', $item->created_at);
        }
        $data['series'] = json_encode([$series]);
        $data['categories'] = json_encode($categories);
        return $data;
    }

}