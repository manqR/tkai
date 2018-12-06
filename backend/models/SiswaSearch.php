<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Siswa;

/**
 * SiswaSearch represents the model behind the search form of `backend\models\Siswa`.
 */
class SiswaSearch extends Siswa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nis', 'kode_siswa', 'nisn', 'nama_lengkap', 'nama_panggilan', 'agama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'tlp', 'tlp_darurat', 'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'email', 'tahun_input', 'tgl_input'], 'safe'],
            [['idcabang', 'idkategori', 'urutan'], 'integer'],
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
        $query = Siswa::find();

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
            'tanggal_lahir' => $this->tanggal_lahir,
            'tahun_input' => $this->tahun_input,
            'tgl_input' => $this->tgl_input,
            'urutan' => $this->urutan,
        ]);

        $query->andFilterWhere(['like', 'nis', $this->nis])
            ->andFilterWhere(['like', 'kode_siswa', $this->kode_siswa])
            ->andFilterWhere(['like', 'nisn', $this->nisn])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'nama_panggilan', $this->nama_panggilan])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'tlp', $this->tlp])
            ->andFilterWhere(['like', 'tlp_darurat', $this->tlp_darurat])
            ->andFilterWhere(['like', 'nama_ayah', $this->nama_ayah])
            ->andFilterWhere(['like', 'nama_ibu', $this->nama_ibu])
            ->andFilterWhere(['like', 'pekerjaan_ayah', $this->pekerjaan_ayah])
            ->andFilterWhere(['like', 'pekerjaan_ibu', $this->pekerjaan_ibu])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
