<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "statistics".
 *
 * @property int $id
 * @property float $income
 * @property float $sales
 * @property int $income_amount
 * @property int $sales_amount
 * @property float|null $discount_price
 * @property float $net_profit
 * @property float $product
 * @property int|null $created_at
 */
class Statistics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statistics';
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
            [['income', 'sales', 'income_amount', 'sales_amount', 'net_profit'], 'required'],
            [['income', 'sales', 'discount_price', 'net_profit', 'product'], 'number'],
            [['income_amount', 'sales_amount', 'created_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'income' => 'Income',
            'sales' => 'Sales',
            'income_amount' => 'Income Amount',
            'sales_amount' => 'Sales Amount',
            'discount_price' => 'Discount Price',
            'net_profit' => 'Net Profit',
            'created_at' => 'Created At',
        ];
    }

    public function isSave(): bool
    {
        $today = strtotime('today');
        $purchase = PurchaseHistory::find()->where(['between', 'created_at', $today, $today + 86400]);
        $orders = Order::find()->where(['between', 'created_at', $today, $today + 86400]);
        $newStat = new $this;
        /* ---- Income ---- */
        $newStat->income = $purchase->select("SUM(purchase_price * amount)")->scalar() ?? 0;
        $newStat->income_amount = $purchase->sum('amount') ?? 0;
        /* ---- Income ---- */

        /* Sales */
        $newStat->sales = $orders->sum('sell_price') ?? 0;
        $newStat->sales_amount = $orders->sum('amount') ?? 0;
        $newStat->discount_price = $orders->sum('discount_price') ?? 0;
        /*--- Sales ---*/

        /*-- Net Profit --*/
        $product_sum = 0;
        foreach ($orders->all() as $value){
            $product_sum += $value->product->purchase_price * $value->amount;
        }
        $newStat->product = $product_sum;
        $discount_sum = $newStat->sales - $newStat->discount_price;
        $newStat->net_profit = $newStat->sales - ($product_sum + $discount_sum);
        /*--- Net profit ---*/

        return $newStat->save();
    }

}
