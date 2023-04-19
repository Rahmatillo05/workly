<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property float $purchase_price
 * @property float $sell_price
 * @property float $discount
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Category $category
 * @property PurchaseHistory[] $purchaseHistories
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'description', 'purchase_price', 'sell_price', 'discount'], 'required'],
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['purchase_price', 'sell_price', 'discount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'purchase_price' => 'Purchase Price',
            'sell_price' => 'Sell Price',
            'discount' => 'Discount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[PurchaseHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPurchaseHistories()
    {
        return $this->hasMany(PurchaseHistory::class, ['product_id' => 'id']);
    }
}
