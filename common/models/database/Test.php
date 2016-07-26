<?php
namespace common\models\database;
use Yii;
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
 * @property string $meta_title
 * @property string $meta_description
 * @property string $meta_keys
 * @property integer $result_type_id
 *
 * @property Question[] $questions
 * @property ResultType $resultType
 * @property TestReferences[] $testReferences
 * @property TestReferences[] $testReferences0
 * @property TestValues[] $testValues
 * @property TestValuesMatrix[] $testValuesMatrices
 */
class Test extends \yii\db\ActiveRecord
{
    public $color;
    public $merchant;
    public $sort;
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
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResultType()
    {
        return $this->hasOne(ResultType::className(), ['id' => 'result_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestReferences()
    {
        return $this->hasMany(TestReferences::className(), ['test_parrent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestReferences0()
    {
        return $this->hasMany(TestReferences::className(), ['test_child_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestValues()
    {
        return $this->hasMany(TestValues::className(), ['test_id' => 'id']);
    }
    
    
    //Rull connection to Question model(table)
    public function getAllTestvalue()
    {
        return $this->hasMany(TestValues::className(), ['test_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestValuesMatrices()
    {
        return $this->hasMany(TestValuesMatrix::className(), ['test_id' => 'id']);
    }
      public function sort($params)
    {
//        $query = Catalog::find();
        $this->load($params);
        if (!$this->validate()) {
//            return $dataProvider;
        }
//        $query->andFilterWhere([
//            'category' => $this->category,
//        ]);
//        return $dataProvider;
    }
}