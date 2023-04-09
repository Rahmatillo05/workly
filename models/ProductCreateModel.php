<?php

namespace app\models;

use yii\base\Model;

/**
 *
 */
class ProductCreateModel extends Model
{
    /**
     * @var
     */
    public $category_id;
    public $name;
    public $description;
    public $has_came_amount;
    public $purchase_price;
    public $sell_price;
    public $discount;

    public function rules()
    {
        return [
            [['category_id', 'name', 'description', 'has_came_amount', 'purchase_price', 'sell_price', 'discount'], 'required'],
            [['name', 'description'], 'string'],
            [['purchase_price', 'sell_price', 'discount'], 'number'],
            [['has_came_amount', 'category_id'], 'integer']
        ];
    }

    /**
     * @return bool
     */
    public function isSave(): bool
    {
        if ($product_id = $this->isProductSave()) {
            if ($this->isProductPriceSave($product_id) && $this->isProductAmountSave($product_id)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return false|int
     */
    private function isProductSave()
    {
        $product = new Product();
        $product->category_id = $this->category_id;
        $product->name = $this->name;
        $product->description = $this->description;
        if ($product->save()) {
            return $product->id;
        }
        return false;
    }

    /**
     * @param $product_id
     * @return bool
     */
    private function isProductPriceSave($product_id): bool
    {
        $model = new ProductPurchaseHistory();
        $model->product_id = $product_id;
        $model->purchase_price = $this->purchase_price;
        $model->sell_price = $this->sell_price;
        $model->discount = $this->discount;
        return $model->save();
    }

    /**
     * @param $product_id
     * @return bool
     */
    private function isProductAmountSave($product_id): bool
    {
        $model = new ProductAmountHistory();
        $model->has_came_amount = $this->has_came_amount;
        $model->sold_amount = 0;
        $model->remaining_amount = $this->has_came_amount;
        $model->product_id = $product_id;
        return $model->save();
    }

}
