<?php

namespace app\models;

use app\models\Product;
use yii\base\Model;

class ProductDiscount extends Model
{
    public $discount;
    public $category_id;

    public function rules()
    {
        return [
            [['discount'], 'integer', 'min' => 0],
            [['category_id', 'discount'], 'required'],
            [['category_id'], 'integer']
        ];
    }

    public function save()
    {
        return Product::updateAll(['last_discount' => $this->discount], ['category_id' => $this->category_id]);
    }
}
