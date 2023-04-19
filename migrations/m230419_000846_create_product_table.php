<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230419_000846_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'category_id'  => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'purchase_price' => $this->money(null, 2)->notNull(),
            'sell_price' => $this->money(null, 2)->notNull(),
            'discount' => $this->money(null, 2)->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-category', 'product', 'category_id', 'category', 'id', 'CASCADE');
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