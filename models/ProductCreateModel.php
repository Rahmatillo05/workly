<?php

namespace app\models;

use yii\base\Model;
use yii\web\ServerErrorHttpException;

/**
 *
 */
class ProductCreateModel extends Model
{
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
            [['has_came_amount', 'category_id'], 'integer'],
            [['sell_price'], 'compare', 'compareAttribute' => 'purchase_price', 'operator' => '>'],
        ];
    }


    public function isProductSave(int $amount_id)
    {
        $product = new Product();
        $product->category_id = $this->category_id;
        $product->name = $this->name;
        $product->description = $this->description;
        $product->amount_id = $amount_id;
        $product->purchase_price = $this->purchase_price;
        $product->sell_price = $this->sell_price;
        $product->discount = $this->discount;
        if ($product->save()) {
            return $this->isPurchaseHistorySave($product->id);
        }
        return $product->errors;
    }

    /**
     * @param $product_id
     * @return bool
     */
    public function isPurchaseHistorySave($product_id): ?bool
    {
        $model = new PurchaseHistory();
        $model->product_id = $product_id;
        $model->purchase_price = $this->purchase_price;
        $model->sell_price = $this->sell_price;
        $model->amount = $this->has_came_amount;
        return $model->save();
    }

    /**
     * @return int|array
     */
    public function isProductAmountSave(): ?int
    {
        $model = new ProductAmount();
        $model->came = $this->has_came_amount;
        $model->sold = 0;
        if ($model->save()) {
            return $model->id;
        }
        return $model->errors;
    }

    public function getCategoryList()
    {
        return Category::find()->all();
    }

}
