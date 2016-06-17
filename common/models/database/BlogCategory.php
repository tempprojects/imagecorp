<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $id
 * @property string $category_alias
 * @property string $title
 * @property integer $sort
 * @property integer $updated_at
 * @property integer $created_at
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_alias', 'title', 'sort', 'updated_at', 'created_at'], 'required'],
            [['category_alias'], 'string'],
            [['sort'], 'integer'],
            [['title'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_alias' => 'Category Alias',
            'title' => 'Title',
            'sort' => 'Sort',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
