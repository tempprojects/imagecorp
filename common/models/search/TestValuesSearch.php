<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\database\TestValues;

/**
 * TestValuesSearch represents the model behind the search form about `common\models\database\TestValues`.
 */
class TestValuesSearch extends TestValues
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test_id'], 'integer'],
            [['from', 'to'], 'number'],
            [['answer', 'query_values'], 'safe'],
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
        $query = TestValues::find();

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
            'test_id' => $this->test_id,
            'from' => $this->from,
            'to' => $this->to,
        ]);

        $query->andFilterWhere(['like', 'answer', $this->answer])
            ->andFilterWhere(['like', 'query_values', $this->query_values]);

        return $dataProvider;
    }
}
