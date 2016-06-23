<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $title
 * @property string $description
 * @property string $buttton_text
 * @property integer $main_image_id
 * @property integer $sub_image_id
 * @property string $value
 *
 * @property Question $question
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id'], 'required'],
            [['question_id', 'main_image_id', 'sub_image_id'], 'integer'],
            [['title', 'description', 'buttton_text', 'value'], 'string'],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
    */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'title' => 'Title',
            'description' => 'Description',
            'buttton_text' => 'Buttton Text',
            'main_image_id' => 'Main Image ID',
            'sub_image_id' => 'Sub Image ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
}
