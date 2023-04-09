<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_amount_history}}`.
 */
class m230409_031335_create_product_amount_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_amount_history}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'has_came_amount' => $this->integer()->notNull(),
            'sold_amount' => $this->integer()->notNull(),
            'remaining_amount' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-product-from-product_amount', 'product_amount_history', 'product_id', 'product', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-product-from-product_amount', 'product_amount_history');
        $this->dropTable('{{%product_amount_history}}');
    }
}
