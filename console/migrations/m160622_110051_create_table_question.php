<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `question`.
 * Has foreign keys to the tables:
 *
 * - `question_type`
 * - `test`
 */
class m160622_110051_create_table_question extends Migration
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
        $this->createTable('question', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'question_type_id' => $this->integer()->notNull(),
            'title' => $this->text()->notNull(),
            'subtitle' => $this->text()->defaultValue(NULL),
            'priority' => $this->tinyint()->defaultValue(NULL),
        ],$tableOptions);

        // creates index for column `test_id`
        $this->createIndex(
            'idx-question-test_id',
            'question',
            'test_id'
        );

        // add foreign key for table `question_type`
        $this->addForeignKey(
            'fk-question-test_id',
            'question',
            'test_id',
            'question_type',
            'id',
            'CASCADE'
        );

        // creates index for column `question_type_id`
        $this->createIndex(
            'idx-question-question_type_id',
            'question',
            'question_type_id'
        );

        // add foreign key for table `test`
        $this->addForeignKey(
            'fk-question-question_type_id',
            'question',
            'question_type_id',
            'test',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `question_type`
        $this->dropForeignKey(
            'fk-question-test_id',
            'question'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-question-test_id',
            'uestion'
        );

        // drops foreign key for table `test`
        $this->dropForeignKey(
            'fk-question-question_type_id',
            'question'
        );

        // drops index for column `question_type_id`
        $this->dropIndex(
            'idx-question-question_type_id',
            'question'
        );

        $this->dropTable('question');
    }
}
