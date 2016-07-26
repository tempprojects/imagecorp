<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "user_test".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $test_value_id
 * @property integer $pay_flag
 *
 * @property TestValues $testValue
 * @property User $user
 */
class UserTest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'test_value_id'], 'required'],
            [['user_id', 'test_value_id', 'pay_flag'], 'integer'],
            [['test_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => TestValues::className(), 'targetAttribute' => ['test_value_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'test_value_id' => 'Test Value ID',
            'pay_flag' => 'Pay Flag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestValue()
    {
        return $this->hasOne(TestValues::className(), ['id' => 'test_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
