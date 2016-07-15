<?php

namespace common\models\database;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\database\TestReferences;

/**
 * TestReferencesSearch represents the model behind the search form about `common\models\database\TestReferences`.
 */
class TestReferencesSearch extends TestReferences
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test_parrent_id', 'test_child_id', 'position'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TestReferences::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'test_parrent_id' => $this->test_parrent_id,
            'test_child_id' => $this->test_child_id,
            'position' => $this->position,
        ]);

        return $dataProvider;
    }
}
