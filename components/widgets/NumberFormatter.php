<?php

namespace app\components\widgets;

use yii\base\Widget;

class NumberFormatter extends Widget
{
    /**
     * If the number is greater than or equal to 1 trillion, divide it by 1 trillion and add a T to the
     * end. If the number is greater than or equal to 1 billion, divide it by 1 billion and add a B to
     * the end. If the number is greater than or equal to 1 million, divide it by 1 million and add a M
     * to the end. If the number is greater than or equal to 1 thousand, divide it by 1 thousand and
     * add a K to the end
     *
     * @param number $number The number you want to format.
     */
    public static function letterFormat($number)
    {
        if ($number !== null) {
            $suffix = '';
            if ($number >= 1e12) {
                $number /= 1e12;
                $suffix = 'T';
            } elseif ($number >= 1e9) {
                $number /= 1e9;
                $suffix = 'B';
            } elseif ($number >= 1e6) {
                $number /= 1e6;
                $suffix = 'M';
            } elseif ($number >= 1e3) {
                $number /= 1e3;
                $suffix = 'K';
            }
            return number_format(round($number, 4), 1) . $suffix;
        } else {
            return 0;
        }
    }
}