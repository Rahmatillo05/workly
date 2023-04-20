<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\StaleObjectException;

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
 * @property Order $orders
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
        return PurchaseHistory::find()->where(['product_id' => $this->id])->orderBy(['id' => SORT_DESC])->limit(2)->all();
    }
    /**
     * Gets query for [[Order]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['product_id' => 'id']);
    }
    public function getCategoryList()
    {
        return Category::find()->orderBy(['id' => SORT_DESC])->all();
    }

    public function getRemaining(): int
    {
        $amount = $this->amount;

        return $amount->came - $amount->sold;
    }

    public function getTotalSpentSum()
    {
        $sum = PurchaseHistory::find()->where(['product_id' => $this->id])->sum('purchase_price');
        return round($sum, 1);
    }

    public function getTotalRemainingSum()
    {
        $sum = $this->getRemaining() * $this->sell_price;
        return round($sum, 1);
    }

    public function amountUpdate($newAmount): bool
    {
        $amount = ProductAmount::findOne($this->amount_id);
        $amount->came += $newAmount;
        return $amount->save();
    }


    public static function multipleUpdate(array $products)
    {
        foreach ($products as $product) {
            $item = Product::findOne($product['id']);
            $item->purchase_price = $product['purchase_price'];
            $item->sell_price = $product['sell_price'];
            $item->discount = $product['discount'];
            $item->save();
        }
    }


}
