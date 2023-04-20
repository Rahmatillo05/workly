<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m230420_001110_create_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%order}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'sell_price' => $this->money(65, 2)->notNull(),
            'created_at' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk-to-category-from-orders', 'order', 'category_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk-to-product-from-orders', 'order', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-category-from-orders', 'order');
        $this->dropForeignKey('fk-to-product-from-orders', 'order');
        $this->dropTable('{{%order}}');
    }
}
