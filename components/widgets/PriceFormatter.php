<?php

namespace app\components\widgets;

use app\models\Product;
use yii\base\Widget;

class PriceFormatter extends Widget
{

    public static function productPurchasePriceDifference($old_price, $new_price): string
    {

        if (is_null($old_price)) {
            return round($new_price, 1) ." $";
        }
        $old_price = round($old_price, 1);
        $new_price = round($new_price, 1);
        $oldDiff = $old_price - $new_price;
        if ($old_price > $new_price) {
            return "<span>{$new_price} $ <i class='badge bg-success bx bxs-arrow-to-bottom'>{$oldDiff} $</i></span>";
        } elseif ($old_price < $new_price) {
            return "<span>{$new_price} $ <i class='badge bg-label-danger bx bxs-arrow-to-top'> {$oldDiff} $</i></span>";
        } else {
            return "<span>{$new_price} $</span>";
        }
    }
    public static function productSellPriceDifference($old_price, $new_price): string
    {
        if (is_null($old_price)) {
            return round($new_price, 1) ." $";
        }
        $old_price = round($old_price, 1);
        $new_price = round($new_price, 1);
        $oldDiff = $old_price - $new_price;

        if ($old_price > $new_price) {
            return "<span>{$new_price} $ <i class='badge bg-label-danger bx bxs-arrow-to-bottom'>{$oldDiff} $</i></span>";
        } elseif ($old_price < $new_price) {
            return "<span>{$new_price} $ <i class='badge bg-success bx bxs-arrow-to-top'> {$oldDiff} $</i></span>";
        } else {
            return "<span>{$new_price} $</span>";
        }
    }
    public static function calculateDiscountSum($price, $discount): float
    {
        $discount_price = $price * ($discount / 100);
        return round($price - $discount_price, 1);
    }
}
