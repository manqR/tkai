<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\KelasGroup;

/**
 * KelasGroupSearch represents the model behind the search form of `backend\models\KelasGroup`.
 */
class KelasGroupSearch extends KelasGroup
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idgroup'], 'integer'],
            [['idkelas', 'wali_kelas', 'status'], 'safe'],
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
        $query = KelasGroup::find();

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
            'idgroup' => $this->idgroup,
        ]);

        $query->andFilterWhere(['like', 'idkelas', $this->idkelas])
            ->andFilterWhere(['like', 'wali_kelas', $this->wali_kelas])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
