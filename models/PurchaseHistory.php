<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "purchase_history".
 *
 * @property int $id
 * @property int $product_id
 * @property int $amount
 * @property float|null $purchase_price
 * @property float|null $sell_price
 * @property int|null $created_at
 *
 * @property Product $product
 */
class PurchaseHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'purchase_history';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'amount', 'sell_price', 'purchase_price'], 'required'],
            [['product_id', 'amount', 'created_at'], 'integer'],
            [['purchase_price', 'sell_price'], 'number'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
            'purchase_price' => 'Purchase Price',
            'sell_price' => 'Sell Price',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function isSave($product_id): bool
    {
        $this->product_id = $product_id;
        if ($this->productUpdate($product_id)){
            return $this->save();
        }
        return false;
    }

    private function productUpdate($product_id): bool
    {
        $product = Product::findOne($product_id);
        $product->purchase_price = $this->purchase_price;
        $product->sell_price = $this->sell_price;
        if ($product->amountUpdate($this->amount)){
            return $product->save();
        }
        return false;
    }
}
