<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_test`.
 */
class m160429_131235_create_table_test extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%test}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(500) NOT NULL',
            'description' => Schema::TYPE_TEXT . ' DEFAULT NULL',
            'alias' => Schema::TYPE_STRING . '(500) NOT NULL',
            'img' => Schema::TYPE_STRING . '(500) NOT NULL',
            'like' => Schema::TYPE_INTEGER . '(20)  DEFAULT 0',
            'sort' => Schema::TYPE_INTEGER . '(1)  DEFAULT 0',
            'type' => Schema::TYPE_INTEGER . '(1)  DEFAULT 0',
            'price' => Schema::TYPE_INTEGER . '(20)  DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%test}}');
    }
}
