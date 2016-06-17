<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property integer $category
 * @property integer $blog_media_id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $alias
 * @property integer $like
 * @property integer $updated_at
 * @property integer $created_at
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'blog_media_id', 'title', 'content', 'alias', 'updated_at', 'created_at'], 'required'],
            [['category', 'blog_media_id', 'like'], 'integer'],
            [['description', 'content'], 'string'],
            [['title', 'alias'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'blog_media_id' => 'Blog Media ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'alias' => 'Alias',
            'like' => 'Like',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
