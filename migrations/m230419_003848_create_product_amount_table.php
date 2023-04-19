<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_amount}}`.
 */
class m230419_003848_create_product_amount_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_amount}}', [
            'id' => $this->primaryKey(),
            'came' => $this->integer()->notNull(),
            'sold' => $this->integer()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_amount}}');
    }
}