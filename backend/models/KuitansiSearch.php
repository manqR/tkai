<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kuitansi;

/**
 * KuitansiSearch represents the model behind the search form of `backend\models\Kuitansi`.
 */
class KuitansiSearch extends Kuitansi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_kuitansi', 'kode_siswa', 'idtagihan', 'remarks', 'keterangan', 'keterangan2', 'tahun_ajaran', 'payment_method', 'bank_name', 'date'], 'safe'],
            [['idcart', 'diskon', 'flag', 'urutan'], 'integer'],
            [['nominal', 'jumlah_bayar'], 'number'],
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
        $query = Kuitansi::find();

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
            'idcart' => $this->idcart,
            'nominal' => $this->nominal,
            'diskon' => $this->diskon,
            'jumlah_bayar' => $this->jumlah_bayar,
            'flag' => $this->flag,
            'date' => $this->date,
            'urutan' => $this->urutan,
        ]);

        $query->andFilterWhere(['like', 'no_kuitansi', $this->no_kuitansi])
            ->andFilterWhere(['like', 'kode_siswa', $this->kode_siswa])
            ->andFilterWhere(['like', 'idtagihan', $this->idtagihan])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'keterangan2', $this->keterangan2])
            ->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran])
            ->andFilterWhere(['like', 'payment_method', $this->payment_method])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name]);

        return $dataProvider;
    }
}
