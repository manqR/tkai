<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\PencatatanKeuangan;

/**
 * PencatatanKeuanganSearch represents the model behind the search form of `backend\models\PencatatanKeuangan`.
 */
class PencatatanKeuanganSearch extends PencatatanKeuangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idcatat', 'flag'], 'integer'],
            [['no_pencatatan', 'kategori', 'keterangan', 'user_create', 'date_create'], 'safe'],
            [['nominal'], 'number'],
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
        $query = PencatatanKeuangan::find();

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
            'idcatat' => $this->idcatat,
            'nominal' => $this->nominal,
            'flag' => $this->flag,
            'date_create' => $this->date_create,
        ]);

        $query->andFilterWhere(['like', 'no_pencatatan', $this->no_pencatatan])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'user_create', $this->user_create]);

        return $dataProvider;
    }
}
