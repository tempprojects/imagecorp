<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\database\BlogMedia as BlogMediaModel;

/**
 * BlogMedia represents the model behind the search form about `common\models\database\BlogMedia`.
 */
class BlogMedia extends BlogMediaModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_media', 'updated_at', 'created_at'], 'integer'],
            [['img', 'slider', 'video'], 'safe'],
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
        $query = BlogMediaModel::find();

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
            'type_media' => $this->type_media,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'slider', $this->slider])
            ->andFilterWhere(['like', 'video', $this->video]);

        return $dataProvider;
    }
}
