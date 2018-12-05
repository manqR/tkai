<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TahunAjaran;

/**
 * TahunAjaranSearch represents the model behind the search form of `backend\models\TahunAjaran`.
 */
class TahunAjaranSearch extends TahunAjaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idajaran', 'status'], 'integer'],
            [['tahun_ajaran'], 'safe'],
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
        $query = TahunAjaran::find();

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
            'idajaran' => $this->idajaran,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran]);

        return $dataProvider;
    }
}
