<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `answer`.
 * Has foreign keys to the tables:
 *
 * - `question`
 */
class m160622_094620_create_table_answer extends Migration
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
        $this->createTable('answer', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->defaultValue(NULL),
            'description' => $this->text()->defaultValue(NULL),
            'buttton_text' => $this->string(255)->defaultValue(NULL),
            'main_image_id' => $this->integer()->defaultValue(NULL),
            'sub_image_id' => $this->integer()->defaultValue(NULL),
            'value' => $this->string(255)->defaultValue(NULL),
        ], $tableOptions);

        // creates index for column `question_id`
        $this->createIndex(
            'idx-answer-question_id',
            'answer',
            'question_id'
        );

        // add foreign key for table `question`
        $this->addForeignKey(
            'fk-answer-question_id',
            'answer',
            'question_id',
            'question',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `question`
        $this->dropForeignKey(
            'fk-answer-question_id',
            'answer'
        );

        // drops index for column `question_id`
        $this->dropIndex(
            'idx-answer-question_id',
            'answer'
        );

        $this->dropTable('answer');
    }
}
