<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "blog_media".
 *
 * @property integer $id
 * @property integer $type_media
 * @property string $img
 * @property string $slider
 * @property string $video
 * @property integer $updated_at
 * @property integer $created_at
 */
class BlogMedia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_media';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_media', 'updated_at', 'created_at'], 'required'],
            [['type_media'], 'integer'],
            [['video'], 'string'],
            [['img', 'slider'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_media' => 'Type Media',
            'img' => 'Img',
            'slider' => 'Slider',
            'video' => 'Video',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
