<?php

namespace common\models\database;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\database\Answer;

/**
 * AnswerTypeSearch represents the model behind the search form about `common\models\database\Answer`.
 */
class AnswerSearch extends Answer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'main_image_id', 'sub_image_id'], 'integer'],
            [['title', 'description', 'buttton_text', 'value'], 'safe'],
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
        $query = Answer::find();

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
            'question_id' => $this->question_id,
            'main_image_id' => $this->main_image_id,
            'sub_image_id' => $this->sub_image_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'buttton_text', $this->buttton_text])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
