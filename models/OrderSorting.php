<?php

namespace app\models;

use yii\base\Model;


class OrderSorting extends Model
{
    public $start_time;
    public $end_time;

    public function rules()
    {
        return [
            [['start_time'], 'required'],
            [['end_time'], 'default', 'value' => date('d-m-Y')],
            [['end_time'], 'default', 'value' => date('d-m-Y')]
        ];
    }

    public function orderSorting()
    {
        $orders = Order::find();
        if (!empty($this->start_time) && !empty($this->end_time)) {
            $start = strtotime($this->start_time);
            $end = strtotime($this->end_time);
            $orders->where(['BETWEEN', 'created_at', $start, $end]);
        }
        return $orders->orderBy(['id' => SORT_DESC])->all();
    }


}
