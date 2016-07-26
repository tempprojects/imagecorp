<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `table_slider`.
 */
class m160429_161421_create_table_slider extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%slider}}', [
            'id' => Schema::TYPE_PK,
            'image_id' => Schema::TYPE_STRING . '(255) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    public function safeDown()
    {
        $this->dropTable('{{%slider}}');
    }
}
