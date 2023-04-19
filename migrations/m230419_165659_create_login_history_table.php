<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%login_history}}`.
 */
class m230419_165659_create_login_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%login_history}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'device' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'ip' => $this->string()->notNull(),
            'status' => $this->smallInteger(0),
            'created_at' => $this->integer()
        ]);
        $this->addForeignKey('fk-to-user-from-login_history', 'login_history', 'user_id', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-to-user-from-login_history', 'login_history');
        $this->dropTable('{{%login_history}}');
    }
}
