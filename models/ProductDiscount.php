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
        $result = false;
        $products = Product::findAll(['category_id' => $this->category_id]);
        foreach ($products as $product) {
            $result = $this->setDiscount($product->id);
        }
        return $result;

    }

    private function setDiscount(int $id)
    {
        $price = ProductPurchaseHistory::find()
            ->where(['product_id' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        $price->discount = $this->discount;

        return $price->save();
    }
}
