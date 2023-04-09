<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int|null $sell_amount
 * @property float|null $sell_price
 * @property int|null $created_at
 *
 * @property Product $product
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
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
            [['product_id', 'sell_amount', 'sell_price'], 'required'],
            [['product_id', 'sell_amount', 'created_at'], 'default', 'value' => null],
            [['product_id', 'sell_amount', 'created_at'], 'integer'],
            [['sell_price'], 'number'],
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
            'product_id' => 'Product',
            'sell_amount' => 'Sell Amount',
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

    public function getProductList()
    {
        return Product::find()->orderBy(['id' => SORT_DESC])->all();
    }

    public function isSave()
    {
        $product_amount = ProductAmountHistory::find()->where(['product_id' => $this->product_id])->orderBy(['id' => SORT_DESC])->one();
        $product_amount->sold_amount = $this->sell_amount;
        $product_amount->remaining_amount = $product_amount->has_came_amount - $product_amount->sold_amount;

        if ($product_amount->save()) {
            return $this->save();
        }
        return false;
    }

    public function todaySoldAmount()
    {
        $today = time();
        $yesterday = $today - 86400;
        return self::find()->where(['BETWEEN', 'created_at', $yesterday, $today])->sum('sell_amount');
    }

    public function todaySalesAmount()
    {
        $today = time();
        $yesterday = $today - 86400;
        return self::find()->where(['BETWEEN', 'created_at', $yesterday, $today])->sum('sell_price');
    }

    public function calculateTotalValue()
    {
        $totalValue = 0;
        $product_amounts = ProductAmountHistory::find()->all();
        $product_prices = ProductPurchaseHistory::find()->all();
        foreach ($product_amounts as $product_amount) {
            foreach ($product_prices as $product_price) {
                if ($product_price->product_id == $product_amount->product_id) {
                    $totalValue += $product_amount->has_came_amount * $product_price->purchase_price;
                }
            }
        }
        return $totalValue;
    }
}
