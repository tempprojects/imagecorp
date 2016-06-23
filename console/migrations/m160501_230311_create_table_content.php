<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_content`.
 */
class m160501_230311_create_table_content extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%content}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . '(500) NOT NULL',
            'description' => Schema::TYPE_TEXT . ' DEFAULT NULL',
            'img' => Schema::TYPE_STRING . '(500) DEFAULT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%content}}');
    }
}
