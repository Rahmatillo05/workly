<?php

namespace app\components\tools;

use app\components\widgets\NumberFormatter;
use app\models\Category;
use app\models\Order;
use app\models\Product;
use app\models\ProductAmount;
use app\models\PurchaseHistory;
use app\models\Statistics;
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
        $profit = PurchaseHistory::find()->select("SUM(purchase_price * amount)")->where(['between', 'created_at', $today, time()])->scalar();
        $sales = Order::find()->where(['between', 'created_at', $today, time()])->sum('discount_price');
        $order_net_price = Order::find()->where(['between', 'created_at', $today, time()])->sum('sell_price');
        $data['profit'] = NumberFormatter::letterFormat($profit);
        $data['sales'] = NumberFormatter::letterFormat($sales);
        $data['net_price'] = NumberFormatter::letterFormat($order_net_price);
        return $data;
    }

    public static function productOrderAmount(int $product_id): array
    {
        $data = [];
        $orders = Order::find()->where(['product_id' => $product_id]);
        $data['all_amount'] = $orders->sum('amount') ?? 0;
        $orders = $orders->all();
        $amount = [];
        foreach ($orders as $order) {
            $amount[] = $order->amount;
        }
        $data['amount'] = json_encode($amount);
        return $data;
    }

    public static function productAllAmount(): array
    {
        $data = [];
        $products = Product::find()->all();
        $product_amount = [];
        $product_name = [];
        /** @var Product $product */
        $order_amount = [];
        $order_net_price = [];
        $order_with_discount = [];
        foreach ($products as $product) {
            $product_name[] = $product->name;
            $product_amount[] = $product->remaining;
            $order_amount[] = $product->amount->sold;
            $order_net_price[] = round($product->price['net_price'], 1);
            $order_with_discount[] = round($product->price['with_discount'], 1);
        }

        $data['amount'] = json_encode($product_amount);
        $data['name'] = json_encode($product_name);
        $data['all_order_amount'] = array_sum($order_amount);
        $data['order_amount'] = json_encode($order_amount);

        $data['order_with_discount_all'] = array_sum($order_with_discount);
        $data['order_net_price_all'] = array_sum($order_net_price);
        $data['order_net_price'] = json_encode($order_net_price);
        $data['order_with_discount'] = json_encode($order_with_discount);
        return $data;
    }

    public static function statisticsData()
    {
        $data = [];

        $statistics = Statistics::find()->all();
        $net_profit = [];
        $sales = [];
        $amount = [];
        $date = [];
        foreach ($statistics as $statistic){
            /** @var Statistics $statistic */
            $net_profit[] = $statistic->net_profit;
            $sales[] = $statistic->sales;
            $amount[] = $statistic->product;
            $date[] = date('d-m-Y', $statistic->created_at);
        }
        $data['net_profit'] = json_encode($net_profit);
        $data['sales'] = json_encode($sales);
        $data['product_sum'] = json_encode($amount);
        $data['date'] = json_encode($date);
        return $data;
    }
}