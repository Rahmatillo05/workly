<?php

namespace app\components\tools;

use app\components\widgets\NumberFormatter;
use app\models\Category;
use app\models\Order;
use app\models\ProductAmount;
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

    public static function productAmountByCategory()
    {
        $data = [];
        $data['all_amount'] = ProductAmount::remaining();
        $categories = Category::find()->all();
        /** @var Category $category */
        $series = [];
        $labels = [];
        foreach ($categories as $category) {
            $product_amount = 0;
            foreach ($category->products as $product) {
                $product_amount += $product->remaining;
            }
            $series[] = $product_amount;
            $labels[] = $category->name;
        }
        $data['series'] = json_encode($series);
        $data['labels'] = json_encode($labels);
        return $data;
    }

    public static function dailyStatistics(): array
    {
        $data = [];
        $today = strtotime("today");
        $profit = PurchaseHistory::find()->where(['between', 'created_at', $today, time()])->sum('purchase_price');
        $sales = Order::find()->where(['between', 'created_at', $today, time()])->sum('discount_price');
        $order_net_price = Order::find()->where(['between', 'created_at', $today, time()])->sum('sell_price');
        $data['profit'] = NumberFormatter::letterFormat($profit);
        $data['sales'] = NumberFormatter::letterFormat($sales);
        $data['net_price'] = NumberFormatter::letterFormat($order_net_price);
        return $data;
    }
}