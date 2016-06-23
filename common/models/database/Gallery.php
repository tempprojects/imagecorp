<?php

namespace common\models\database;

use Yii;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $type
 * @property string $src
 * @property string $name
 * @property string $extension
 * @property string $alt
 * @property string $title
 * @property string $data
 * @property integer $created_at
 * @property integer $updated_at
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'src', 'name', 'extension', 'alt', 'title', 'data', 'created_at', 'updated_at'], 'required'],
            [['src', 'name', 'data'], 'string'],
            [['type', 'extension'], 'string', 'max' => 20],
            [['alt', 'title'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'src' => 'Src',
            'name' => 'Name',
            'extension' => 'Extension',
            'alt' => 'Alt',
            'title' => 'Title',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
