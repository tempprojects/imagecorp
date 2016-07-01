<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation for table `test_values`.
 * Has foreign keys to the tables:
 *
 * - `test`
 */
class m160629_134633_create_table_test_values extends Migration
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
        $this->createTable('test_values', [
            'id' => $this->primaryKey(),
            'test_id' => $this->integer()->notNull(),
            'from' => $this->integer()->notNull(),
            'to' => $this->integer()->notNull(),
            'answer' => $this->string(255)->notNull(),
            'query_values' => $this->text()->notNull(),
        ], $tableOptions);

        // creates index for column `test_id`
        $this->createIndex(
            'idx-test_values-test_id',
            'test_values',
            'test_id'
        );

        // add foreign key for table `test`
        $this->addForeignKey(
            'fk-test_values-test_id',
            'test_values',
            'test_id',
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
        // drops foreign key for table `test`
        $this->dropForeignKey(
            'fk-test_values-test_id',
            'test_values'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-test_values-test_id',
            'test_values'
        );

        $this->dropTable('test_values');
    }
}
