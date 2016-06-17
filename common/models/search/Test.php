<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\database\Test as TestModel;

/**
 * Test represents the model behind the search form about `common\models\database\Test`.
 */
class Test extends TestModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'like', 'sort', 'type', 'updated_at', 'created_at'], 'integer'],
            [['title', 'description', 'alias', 'img'], 'safe'],
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
        $query = TestModel::find();

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
            'like' => $this->like,
            'sort' => $this->sort,
            'type' => $this->type,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'alias', $this->alias])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $dataProvider;
    }
}
