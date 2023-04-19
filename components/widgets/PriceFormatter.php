<?php

namespace app\components\widgets;

use app\models\Product;
use yii\base\Widget;

class PriceFormatter extends Widget
{


    public function init()
    {
        parent::init();
    }

    public static function productPurchasePriceDifference(Product $product): string
    {
        $price = round($product->purchaseHistories[0]->purchase_price, 1);

        if (!isset($product->purchaseHistories[1])) {
            return "{$price} $";
        }

        $oldPrice = $product->purchaseHistories[1]->purchase_price;
        $newPrice = $product->purchaseHistories[0]->purchase_price;
        $oldDiff = $newPrice - $oldPrice;

        if ($oldPrice > $newPrice) {
            return "<span>{$price} $ <i class='badge bg-success bx bx-minus'>{$oldDiff}</i></span>";
        } elseif ($oldPrice < $newPrice) {
            return "<span>{$price} $ <i class='badge bg-label-danger bx bx-plus'> {$oldDiff} $</i></span>";
        } else {
            return "<span>{$price} $</span>";
        }
    }
    public static function productSellPriceDifference(Product $product): string
    {
        $price = round($product->purchaseHistories[0]->sell_price, 1);

        if (!isset($product->purchaseHistories[1])) {
            return "{$price} $";
        }

        $oldPrice = $product->purchaseHistories[1]->sell_price;
        $newPrice = $product->purchaseHistories[0]->sell_price;
        $oldDiff = $newPrice - $oldPrice;

        if ($oldPrice > $newPrice) {
            return "<span>{$price} $ <i class='badge bg-success bx bx-minus'>{$oldDiff}</i></span>";
        } elseif ($oldPrice < $newPrice) {
            return "<span>{$price} $ <i class='badge bg-label-danger bx bx-minus'> {$oldDiff} $</i></span>";
        } else {
            return "<span>{$price} $</span>";
        }
    }
    public static function calculateDiscountSum($price, $discount): float
    {
        $discount_price = $price * ($discount / 100);
        return round($price - $discount_price, 1);
    }
}
