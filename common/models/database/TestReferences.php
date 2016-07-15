<?php

namespace common\models\database;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "test_references".
 *
 * @property integer $id
 * @property integer $test_parrent_id
 * @property integer $test_child_id
 * @property integer $position
 *
 * @property Test $testParrent
 * @property Test $testChild
 */
class TestReferences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test_references';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['test_parrent_id', 'test_child_id', 'position'], 'required'],
            [['test_parrent_id', 'test_child_id', 'position'], 'integer'],
            [['test_parrent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_parrent_id' => 'id']],
            [['test_child_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test::className(), 'targetAttribute' => ['test_child_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'test_parrent_id' => 'Test Parrent ID',
            'test_child_id' => 'Test Child ID',
            'position' => 'Position',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestParrent()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_parrent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTestChild()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_child_id']);
    }
    
    /**
     * @return array of tests
     */
    public function getAvilabletests()
    {
        $queryTests = new Query;
        $queryTests->select('test_child_id')->from('test_references')
                    ->where([ 'test_parrent_id'=> [$this->getAttribute('test_parrent_id')]]);
        
        $resultReferenceTests = $queryTests->all();
        $resultReferenceTests = array_column($resultReferenceTests, 'test_child_id');


        $query = new Query;
        $query->select('id, title, type')->from('test')
                ->where(['not in', 'id', [$this->getAttribute('test_parrent_id')]])
                ->andWhere(['not in', 'result_type_id', [3]])
                ->andWhere(['not in', 'id', [3]]);

        if($resultReferenceTests){
             $query->andWhere(['not in', 'id', $resultReferenceTests]);
        }
 
        $tests = $query->all();

        $resultArray = array();
        array_walk($tests, function (&$value,$key) use (&$resultArray) {
            $type =[
                1 => 'Женщина',
                2 => 'Мужчина',
                3 => 'Свадьба',
            ];
            $resultArray[$value['id'] ] = $value['title'] . ' (' . $type[$value['type']] . ')';
        });

        return $resultArray;
    }
}
