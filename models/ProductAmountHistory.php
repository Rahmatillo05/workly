<?php

namespace app\models;

use Yii;

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
}
