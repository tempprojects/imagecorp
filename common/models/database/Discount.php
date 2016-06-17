<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "discount".
 *
 * @property integer $id
 * @property integer $id_test
 * @property integer $amount
 * @property integer $status
 * @property integer $updated_at
 * @property integer $created_at
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_test', 'amount', 'status'], 'integer'],
            [['updated_at', 'created_at'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_test' => 'Id Test',
            'amount' => 'Amount',
            'status' => 'Status',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
