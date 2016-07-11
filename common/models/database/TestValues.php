<?php

namespace common\models\database;

use Yii;
use yii\db\Query;

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
            [['test_id', 'answer', 'query_values', 'page_title', 'page_description'], 'required'],
            [['test_id'], 'integer'],
            [['from', 'to'], 'number'],
            [['query_values'], 'string'],
            [['answer', 'page_title', 'page_description'], 'string', 'max' => 255],
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
            'page_title' => 'Page Title',
            'page_description' => 'Page Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    public function getUserTests()
    {
        return $this->hasMany(UserTest::className(), ['test_value_id' => 'id']);
    }

    protected function getQuestions()
    {
        $query = new Query;
        $query->select('id, subtitle')->from('question')->where(['test_id' => $this->getAttribute('test_id')]);
        $roles = $query->all();
        $result = array_column($roles, 'subtitle', 'id');
        return $result; 
    }

    public static function getTestValues($id)
    {
        $query = new Query;
        $query->select('id, answer')->from('test_values')->where(['test_id' => $id]);
        $roles = $query->all();
        $result = array_column($roles, 'answer', 'id');
        return $result; 
    }
}
