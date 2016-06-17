<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_discount`.
 */
class m160429_211315_create_table_discount extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%discount}}', [
            'id' => Schema::TYPE_PK,
            'id_test' => Schema::TYPE_INTEGER . '(20)  DEFAULT 0',
            'amount' => Schema::TYPE_INTEGER . '(20)  DEFAULT 0',
            'status' => Schema::TYPE_INTEGER . '(1)  DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%discount}}');
    }
}
