<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $test_id
 * @property integer $question_type_id
 * @property string $title
 * @property string $subtitle
 * @property integer $priority
 * @property string $button_text
 * @property integer $image_id
 * @property string $description
 *
 * @property Answer[] $answers
 * @property QuestionType $questionType
 * @property Test $test
 * @property Gallery $image
 */
class Question extends \yii\db\ActiveRecord
{
    //Options for select in the question 
    public $answers_cnt = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_id', 'question_type_id', 'title', 'answers_cnt', 'priority'], 'required'],
            [['test_id', 'question_type_id', 'priority', 'image_id', 'answers_cnt'], 'integer'],
            [['title', 'subtitle', 'description'], 'string'],
            [['button_text'], 'string', 'max' => 60],
            [['question_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => QuestionType::className(), 'targetAttribute' => ['question_type_id' => 'id']],
            [['test_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_id' => 'id']],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['image_id' => 'id']],
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
            'question_type_id' => 'Question Type ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'priority' => 'Priority',
            'button_text' => 'Button Text',
            'image_id' => 'Image ID',
            'description' => 'Description',
            'answers_cnt' => 'Answers Count'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionType()
    {
        return $this->hasOne(QuestionType::className(), ['id' => 'question_type_id']);
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
    public function getImage()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'image_id']);
    }
    
    /*
    *Deleting all answers
    */
    public function beforeDelete()
    {
        if($this->answers){
            foreach ($this->answers as $answer){
                $answer->delete();
            }
        }
    }
}