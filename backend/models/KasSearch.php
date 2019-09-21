<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kas;

/**
 * KasSearch represents the model behind the search form of `backend\models\Kas`.
 */
class KasSearch extends Kas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idkas'], 'integer'],
            [['nominal'], 'number'],
            [['last_update', 'update_by'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Kas::find();

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
            'idkas' => $this->idkas,
            'nominal' => $this->nominal,
            'last_update' => $this->last_update,
        ]);

        $query->andFilterWhere(['like', 'update_by', $this->update_by]);

        return $dataProvider;
    }
}
