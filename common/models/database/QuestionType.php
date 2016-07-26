<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "question_type".
 *
 * @property integer $id
 * @property string $slug
 * @property string $description
 *
 * @property Question[] $questions
 */
class QuestionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug', 'description'], 'required'],
            [['slug', 'description'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'slug' => 'Slug',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['question_type_id' => 'id']);
    }
}
