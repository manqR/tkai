<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TagihanLain;

/**
 * TagihanLainSearch represents the model behind the search form of `backend\models\TagihanLain`.
 */
class TagihanLainSearch extends TagihanLain
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtagihan', 'nama_tagihan', 'created_by', 'created_date'], 'safe'],
            [['nominal'], 'number'],
            [['urutan'], 'integer'],
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
        $query = TagihanLain::find();

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
            'nominal' => $this->nominal,
            'created_date' => $this->created_date,
            'urutan' => $this->urutan,
        ]);

        $query->andFilterWhere(['like', 'idtagihan', $this->idtagihan])
            ->andFilterWhere(['like', 'nama_tagihan', $this->nama_tagihan])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
}
