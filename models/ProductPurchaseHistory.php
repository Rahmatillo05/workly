<?php

namespace app\models;

use Yii;
use app\models\Product;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product_purchase_history".
 *
 * @property int $id
 * @property float $purchase_price
 * @property float $sell_price
 * @property float $discount
 * @property int|null $product_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Product $product
 */
class ProductPurchaseHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_purchase_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['purchase_price', 'sell_price', 'discount'], 'required'],
            [['purchase_price', 'sell_price', 'discount'], 'number'],
            [['product_id', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['product_id', 'created_at', 'updated_at'], 'integer'],
            [['sell_price'], 'compare', 'compareAttribute' => 'purchase_price', 'operator'=>'>='],
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
            'purchase_price' => 'Purchase Price',
            'sell_price' => 'Sell Price',
            'discount' => 'Discount',
            'product_id' => 'Product ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }


    public function multipleUpdated(array $products)
    {
        $result = false;
        foreach ($products as $product) {
            $model = self::findOne($product['id']);
            $model->purchase_price = $product['purchase_price'];
            $model->sell_price = $product['sell_price'];
            $model->discount = $product['discount'];
            $result = $model->save();
        }
        return $result;
    }
}
