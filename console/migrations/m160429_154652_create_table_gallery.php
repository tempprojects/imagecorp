<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_gallery`.
 */
class m160429_154652_create_table_gallery extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%gallery}}', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . '(20) NOT NULL',
            'src' => Schema::TYPE_TEXT . '(1000) NOT NULL',
            'name' => Schema::TYPE_TEXT . '(1000) NOT NULL',
            'extension' => Schema::TYPE_STRING . '(20) NOT NULL',
            'alt' => Schema::TYPE_STRING . '(500) NOT NULL',
            'title' => Schema::TYPE_STRING . '(500) NOT NULL',
            'data' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%gallery}}');
    }
}
