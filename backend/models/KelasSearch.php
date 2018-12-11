<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Kelas;

/**
 * KelasSearch represents the model behind the search form of `backend\models\Kelas`.
 */
class KelasSearch extends Kelas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'tahun_ajaran', 'wali_kelas', 'key_'], 'safe'],
            [['idkategori', 'idcabang', 'flag', 'urutan'], 'integer'],
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
        $query = Kelas::find();

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
            'idkategori' => $this->idkategori,
            'idcabang' => $this->idcabang,
            'tahun_ajaran' => $this->tahun_ajaran,
            'flag' => $this->flag,
            'urutan' => $this->urutan,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'wali_kelas', $this->wali_kelas])
            ->andFilterWhere(['like', 'key_', $this->key_]);

        return $dataProvider;
    }
}
