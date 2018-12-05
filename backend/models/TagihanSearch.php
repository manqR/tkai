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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtagihan', 'idkelas', 'idjurusan', 'user_create', 'date_create', 'user_update', 'date_update'], 'safe'],
            [['idajaran'], 'integer'],
            [['administrasi', 'pengembangan', 'praktik', 'semester_a', 'semester_b', 'lab_inggris', 'lks', 'perpustakaan', 'osis', 'mpls', 'asuransi'], 'number'],
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
            'idajaran' => $this->idajaran,
            'administrasi' => $this->administrasi,
            'pengembangan' => $this->pengembangan,
            'praktik' => $this->praktik,
            'semester_a' => $this->semester_a,
            'semester_b' => $this->semester_b,
            'lab_inggris' => $this->lab_inggris,
            'lks' => $this->lks,
            'perpustakaan' => $this->perpustakaan,
            'osis' => $this->osis,
            'mpls' => $this->mpls,
            'asuransi' => $this->asuransi,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
        ]);

        $query->andFilterWhere(['like', 'idtagihan', $this->idtagihan])
            ->andFilterWhere(['like', 'idkelas', $this->idkelas])
            ->andFilterWhere(['like', 'idjurusan', $this->idjurusan])
            ->andFilterWhere(['like', 'user_create', $this->user_create])
            ->andFilterWhere(['like', 'user_update', $this->user_update]);

        return $dataProvider;
    }
}
