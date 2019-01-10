<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Tagihan;

/**
 * TagihanSearch represents the model behind the search form of `backend\models\Tagihan`.
 */
class TagihanSearch extends Tagihan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtagihan', 'tahun_ajaran'], 'safe'],
            [['idcabang', 'idkategori', 'urutan'], 'integer'],
            [['seragam', 'peralatan', 'uang_pangkal', 'uang_bangunan', 'material'], 'number'],
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
        $query = Tagihan::find();

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
            'idcabang' => $this->idcabang,
            'idkategori' => $this->idkategori,
            'seragam' => $this->seragam,
            'peralatan' => $this->peralatan,
            'uang_pangkal' => $this->uang_pangkal,
            'uang_bangunan' => $this->uang_bangunan,
            'material' => $this->material,
            'urutan' => $this->urutan,
        ]);

        $query->andFilterWhere(['like', 'idtagihan', $this->idtagihan])
            ->andFilterWhere(['like', 'tahun_ajaran', $this->tahun_ajaran]);

        return $dataProvider;
    }
}
