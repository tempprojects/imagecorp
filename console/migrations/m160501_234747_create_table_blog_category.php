<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_blog_category`.
 */
class m160501_234747_create_table_blog_category extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_category}}', [
            'id' => Schema::TYPE_PK,
            'category_alias' => Schema::TYPE_TEXT . '(1000) NOT NULL',
            'title' => Schema::TYPE_STRING . '(500) NOT NULL',
            'sort' => Schema::TYPE_INTEGER . '(3) NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_category}}');
    }
}
