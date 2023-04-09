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

    public static function productPriceDifference(Product $product): string
    {
        $price = round($product->productPurchaseHistories[0]->purchase_price, 1);

        if (!isset($product->productPriceHistories[1])) {
            return "{$price} $";
        }

        $oldPrice = $product->productPurchaseHistories[1]->purchase_price;
        $newPrice = $product->productPurchaseHistories[0]->purchase_price;
        $oldDiff = $newPrice - $oldPrice;

        if ($oldPrice > $newPrice) {
            return "<span>{$price} $ <i class='badge bg-success bx bxs-arrow-to-bottom'>{$oldDiff}</i></span>";
        } elseif ($oldPrice < $newPrice) {
            return "<span>{$price} $ <i class='badge bg-label-danger bx bxs-arrow-to-top'> {$oldDiff} $</i></span>";
        } else {
            return "<span>{$price} $</span>";
        }
    }

    public static function calculateDiscountSum($price, $discount)
    {
        $discount_price = $price * ($discount / 100);
        return round($price - $discount_price, 1);
    }
}
