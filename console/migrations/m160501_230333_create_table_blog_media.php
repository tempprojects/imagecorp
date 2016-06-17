<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_blog_media`.
 */
class m160501_230333_create_table_blog_media extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%blog_media}}', [
            'id' => Schema::TYPE_PK,
            'type_media' => Schema::TYPE_INTEGER . '(1) NOT NULL',
            'img' => Schema::TYPE_STRING . '(500) NOT NULL',
            'slider' => Schema::TYPE_STRING . '(500) NOT NULL',
            'video' => Schema::TYPE_TEXT . '(1000) NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

    }

    public function safeDown()
    {
        $this->dropTable('{{%blog_media}}');
    }
}
