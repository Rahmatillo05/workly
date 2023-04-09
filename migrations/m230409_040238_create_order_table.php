<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m230409_040238_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'sell_amount' => $this->integer(),
            'sell_price' => $this->money(30, 2),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-product-from-order', 'order', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-product-from-order', 'order');
        $this->dropTable('{{%order}}');
    }
}
