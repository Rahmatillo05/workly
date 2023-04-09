<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_purchase_history}}`.
 */
class m230409_032154_create_product_purchase_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_purchase_history}}', [
            'id' => $this->primaryKey(),
            'purchase_price' => $this->money(25, 2)->notNull(),
            'sell_price' => $this->money(25, 2)->notNull(),
            'discount' => $this->float(25, 2)->notNull(),
            'product_id' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-product-from-product_price', 'product_purchase_history', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-product-from-product_price', 'product_purchase_history');
        $this->dropTable('{{%product_purchase_history}}');
    }
}
