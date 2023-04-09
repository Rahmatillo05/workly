<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_amount_history".
 *
 * @property int $id
 * @property int|null $product_id
 * @property int $has_came_amount
 * @property int $sold_amount
 * @property int $remaining_amount
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product $product
 */
class ProductAmountHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_amount_history';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class
            ]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'has_came_amount', 'sold_amount', 'remaining_amount', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['product_id', 'has_came_amount', 'sold_amount', 'remaining_amount', 'created_at', 'updated_at'], 'integer'],
            [['has_came_amount', 'sold_amount', 'remaining_amount'], 'required'],
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
            'has_came_amount' => 'Has Came Amount',
            'sold_amount' => 'Sold Amount',
            'remaining_amount' => 'Remaining Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
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

    public function isSave($product_id)
    {
        $this->sold_amount = 0;
        $this->remaining_amount = $this->has_came_amount;
        $this->product_id = $product_id;
        return $this->product_id ?? $this->save();
    }
}
