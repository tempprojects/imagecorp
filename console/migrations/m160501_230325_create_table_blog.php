<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_blog`.
 */
class m160501_230325_create_table_blog extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog}}', [
            'id' => Schema::TYPE_PK,
            'category' => Schema::TYPE_INTEGER . '(5) NOT NULL',
            'blog_media_id' => Schema::TYPE_INTEGER . '(20) NOT NULL',
            'title' => Schema::TYPE_STRING . '(500) NOT NULL',
            'description' => Schema::TYPE_TEXT . ' DEFAULT NULL',
            'content' => Schema::TYPE_TEXT . '   NOT NULL',
            'alias' => Schema::TYPE_STRING . '(500) NOT NULL',
            'like' => Schema::TYPE_INTEGER . '(20)  DEFAULT 0',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%blog}}');
    }
}
