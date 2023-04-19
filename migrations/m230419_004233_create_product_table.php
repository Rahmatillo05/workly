<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230419_004233_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id'  => $this->integer()->notNull(),
            'amount_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'purchase_price' => $this->money(65, 2)->notNull(),
            'sell_price' => $this->money(65, 2)->notNull(),
            'discount' => $this->money(65, 1)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-category', 'product', 'category_id', 'category', 'id', 'CASCADE');
        $this->addForeignKey('fk-to-amount', 'product', 'amount_id', 'product_amount', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-category', 'product');

        $this->dropTable('{{%product}}');
    }
}
