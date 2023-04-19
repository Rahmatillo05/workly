<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%purchase_history}}`.
 */
class m230419_004539_create_purchase_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%purchase_history}}', [
            'id' => $this->primaryKey(),
            'product_id'  => $this->integer()->notNull(),
            'amount' => $this->integer()->notNull(),
            'purchase_price' => $this->money(65, 2),
            'sell_price' => $this->money(65, 2),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-product-from-history', 'purchase_history', 'product_id', 'product', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-product-from-history', 'purchase_history');
        $this->dropTable('{{%purchase_history}}');
    }
}
