<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_amount".
 *
 * @property int $id
 * @property int $came
 * @property int $sold
 *
 * @property Product[] $products
 */
class ProductAmount extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_amount';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['came', 'sold'], 'required'],
            [['came', 'sold'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'came' => 'Came',
            'sold' => 'Sold',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['amount_id' => 'id']);
    }
}
