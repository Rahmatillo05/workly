<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property int $amount_id
 * @property string $name
 * @property string $description
 * @property float $purchase_price
 * @property float $sell_price
 * @property float $discount
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ProductAmount $amount
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
            [['category_id', 'amount_id', 'name', 'description', 'purchase_price', 'sell_price', 'discount'], 'required'],
            [['category_id', 'amount_id', 'created_at', 'updated_at'], 'integer'],
            [['description'], 'string'],
            [['purchase_price', 'sell_price', 'discount'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['amount_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductAmount::class, 'targetAttribute' => ['amount_id' => 'id']],
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
            'category_id' => 'Category',
            'amount_id' => 'Amount',
            'name' => 'Name',
            'description' => 'Description',
            'purchase_price' => 'Purchase Price $',
            'sell_price' => 'Sell Price $',
            'discount' => 'Discount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Amount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAmount()
    {
        return $this->hasOne(ProductAmount::class, ['id' => 'amount_id']);
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

    public function getRemainingAmount(): int
    {
        $amount = $this->amount;

        return $amount->came - $amount->sold;
    }
}
