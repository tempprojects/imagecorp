<?php

namespace common\models\database;

use Yii;
use common\models\database\Question;
use common\models\database\TestValues;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $alias
 * @property string $img
 * @property integer $like
 * @property integer $sort
 * @property integer $type
 * @property integer $price
 * @property integer $updated_at
 * @property integer $created_at
 */
class Test extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias', 'img', 'updated_at', 'created_at','result_type_id'], 'required'],
            [['description', ], 'string'],
            [['meta_description'], 'string', 'max' => 170],
            [['meta_title'], 'string', 'max' => 120],
            [['meta_keys'], 'string', 'max' => 160],
            [['like', 'sort', 'type', 'price', 'result_type_id'], 'integer'],
            [['title', 'alias', 'img'], 'string', 'max' => 500],
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
            'alias' => 'Alias',
            'img' => 'Img',
            'like' => 'Like',
            'sort' => 'Sort',
            'type' => 'Type',
            'price' => 'Price',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'result_type_id' => 'Result',
            'meta_description' => 'Meta description',
            'meta_title' => 'Meta title',
            'meta_keys' => 'Meta keys',
        ];
    }
    
    //Rull connection to Question model(table)
    public function getQuestion()
    {
        return $this->hasMany(Question::className(), ['test_id' => 'id']);
    }

    //Rull connection to Question model(table)
    public function getTestValues()
    {
        return $this->hasMany(TestValues::className(), ['test_id' => 'id']);
    }

    //Rull connection to Question model(table)
    public function getAllTestvalue()
    {
        return $this->hasMany(TestValues::className(), ['test_id' => 'id']);
    }
}
