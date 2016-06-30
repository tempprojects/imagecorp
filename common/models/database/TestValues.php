<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "test_values".
 *
 * @property integer $id
 * @property integer $test_id
 * @property double $from
 * @property double $to
 * @property string $answer
 * @property string $query_values
 *
 * @property Test $test
 */
class TestValues extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_values';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'from', 'to', 'answer', 'query_values'], 'required'],
            [['test_id'], 'integer'],
            [['from', 'to'], 'number'],
            [['answer', 'query_values'], 'string'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_id' => 'Test ID',
            'from' => 'From',
            'to' => 'To',
            'answer' => 'Answer',
            'query_values' => 'Query Values',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }
}
