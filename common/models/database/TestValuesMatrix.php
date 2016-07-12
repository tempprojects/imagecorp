<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "test_values_matrix".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $question_horizontal_id
 * @property integer $question_vertical_id
 * @property string $serialize
 * @property integer $active_flag
 *
 * @property Test $test
 * @property Question $questionHorizontal
 * @property Question $questionVertical
 * @property TestValues $testValues
 */
class TestValuesMatrix extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc 
    */
    public static function tableName()
    {
        return 'test_values_matrix';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'question_horizontal_id', 'question_vertical_id'], 'required'],
            [['test_id', 'question_horizontal_id', 'question_vertical_id', 'active_flag'], 'integer'],
            [['serialize'], 'string'],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['question_horizontal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_horizontal_id' => 'id']],
            [['question_vertical_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_vertical_id' => 'id']]
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
            'question_horizontal_id' => 'Question Horizontal ID',
            'question_vertical_id' => 'Question Vertical ID',
            'serialize' => 'Serialize',
            'active_flag' => 'Active Flag',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionHorizontal()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_horizontal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionVertical()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_vertical_id']);
    }
}
