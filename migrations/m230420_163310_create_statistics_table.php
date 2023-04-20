<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%statistics}}`.
 */
class m230420_163310_create_statistics_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%statistics}}', [
            'id' => $this->primaryKey(),
            'income' => $this->money(65, 2)->notNull(),
            'sales' => $this->money(65, 2)->notNull(),
            'income_amount' => $this->integer()->notNull(),
            'sales_amount' => $this->integer()->notNull(),
            'discount_price' => $this->money(65, 2),
            'created_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%statistics}}');
    }
}
