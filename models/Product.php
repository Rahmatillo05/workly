<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $description
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Category $category
 * @property Order[] $orders
 * @property ProductAmountHistory[] $productAmountHistories
 * @property ProductPurchaseHistory[] $productPurchaseHistories
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
            [['category_id', 'name', 'description'], 'required'],
            [['category_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
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
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductAmountHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductAmountHistories()
    {
        return $this->hasMany(ProductAmountHistory::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductPurchaseHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductPurchaseHistories()
    {
        return $this->hasMany(ProductPurchaseHistory::class, ['product_id' => 'id']);
    }
}
