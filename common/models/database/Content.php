<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $img
 * @property integer $updated_at
 * @property integer $created_at
 */
class Content extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'updated_at', 'created_at'], 'required'],
            [['description'], 'string'],
            [['title', 'img'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'img' => 'Img',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
