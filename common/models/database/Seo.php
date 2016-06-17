<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "seo".
 *
 * @property integer $id
 * @property string $page_alias
 * @property string $title
 * @property string $description
 * @property string $img
 * @property string $content
 * @property integer $updated_at
 * @property integer $created_at
 */
class Seo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_alias', 'title', 'description', 'img', 'content', 'updated_at', 'created_at'], 'required'],
            [['page_alias', 'img', 'content'], 'string'],
            [['title', 'description'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_alias' => 'Page Alias',
            'title' => 'Title',
            'description' => 'Description',
            'img' => 'Img',
            'content' => 'Content',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
