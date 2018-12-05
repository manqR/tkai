<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TagihanSiswa;

/**
 * TagihanSiswaSearch represents the model behind the search form of `backend\models\TagihanSiswa`.
 */
class TagihanSiswaSearch extends TagihanSiswa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtagihan_siswa'], 'integer'],
            [['idtagihan', 'idsiswa', 'tahun_ajaran', 'nama_tagihan', 'keterangan', 'user_create', 'date_create'], 'safe'],
            [['besaran'], 'number'],
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
        $query = TagihanSiswa::find();

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
            'idtagihan_siswa' => $this->idtagihan_siswa,
            'besaran' => $this->besaran,
            'date_create' => $this->date_create,
        ]);

        $query->andFilterWhere(['like', 'idsiswa', $this->idsiswa])
            ->andFilterWhere(['like', 'idgroup', $this->idgroup])
            ->andFilterWhere(['like', 'nama_tagihan', $this->nama_tagihan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'user_create', $this->user_create]);

        return $dataProvider;
    }
}
