<?php

namespace common\models\database;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\database\TestValuesMatrix;

/**
 * TestValuesMatrixSearch represents the model behind the search form about `common\models\database\TestValuesMatrix`.
 */
class TestValuesMatrixSearch extends TestValuesMatrix
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'test_id', 'question_horizontal_id', 'question_vertical_id', 'active_flag'], 'integer'],
            [['serialize'], 'safe'],
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
        $query = TestValuesMatrix::find();

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
            'question_horizontal_id' => $this->question_horizontal_id,
            'question_vertical_id' => $this->question_vertical_id,
            'active_flag' => $this->active_flag,
        ]);

        $query->andFilterWhere(['like', 'serialize', $this->serialize]);

        return $dataProvider;
    }
}
