<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `question_type`.
 */
class m160622_123511_create_table_question_type extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('question_type', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('question_type');
    }
}
