<?php

use yii\db\Migration;

/**
 * Handles the dropping for table `table_user`.
 */
class m160429_103509_drop_table_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('user');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        return false;
    }
}
