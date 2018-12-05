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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkelas', 'idajaran', 'status'], 'integer'],
            [['kode', 'idjurusan', 'nama_kelas'], 'safe'],
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
            'idkelas' => $this->idkelas,
            'idajaran' => $this->idajaran,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'kode', $this->kode])
            ->andFilterWhere(['like', 'idjurusan', $this->idjurusan])
            ->andFilterWhere(['like', 'nama_kelas', $this->nama_kelas]);

        return $dataProvider;
    }
}
