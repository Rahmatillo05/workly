<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $category_id
 * @property int $product_id
 * @property int $amount
 * @property float $sell_price
 * @property float $discount_price
 * @property int $created_at
 *
 * @property Category $category
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
            [['category_id', 'product_id', 'amount', 'sell_price', 'discount_price'], 'required'],
            [['category_id', 'product_id', 'amount', 'created_at'], 'integer'],
            [['sell_price', 'discount_price'], 'number'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
            'product_id' => 'Product',
            'amount' => 'Amount',
            'sell_price' => 'Sell Price',
            'created_at' => 'Created At',
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
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategoryList()
    {
        return Category::find()->orderBy(['id' => SORT_DESC])->all();
    }
    public function getProductList()
    {
        return Product::find()->orderBy(['id' => SORT_DESC])->all();
    }

    public function isSave()
    {
        $product = Product::findOne($this->product_id);
        $this->category_id = $product->category_id;
        $this->productAmountChange($product->amount_id, $this->amount);
        return $this->save() ? true : $this->errors;
    }

    private function productAmountChange(int $amount_id, int $amount_value): bool
    {
        $amount = ProductAmount::findOne($amount_id);
        $amount->sold += $amount_value;
        return $amount->save();
    }
}
