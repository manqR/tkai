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
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'nama_lengkap', 'jenis_kelamin', 'nisn', 'no_seri_ijazah_smp', 'no_seri_skhun_smp', 'no_ujian_nasional', 'nik', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'transportasi', 'tlp_rumah', 'hp', 'email', 'status_kps', 'no_kps', 'user_create', 'date_create', 'user_update', 'date_update'], 'safe'],
            [['tinggi_badan', 'jarak_tempat_tinggal', 'waktu_tempuh', 'jml_saudara'], 'integer'],
            [['berat_badan'], 'number'],
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
            'tanggal_lahir' => $this->tanggal_lahir,
            'tinggi_badan' => $this->tinggi_badan,
            'berat_badan' => $this->berat_badan,
            'jarak_tempat_tinggal' => $this->jarak_tempat_tinggal,
            'waktu_tempuh' => $this->waktu_tempuh,
            'jml_saudara' => $this->jml_saudara,
            'date_create' => $this->date_create,
            'date_update' => $this->date_update,
        ]);

        $query->andFilterWhere(['like', 'idsiswa', $this->idsiswa])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'nisn', $this->nisn])
            ->andFilterWhere(['like', 'no_seri_ijazah_smp', $this->no_seri_ijazah_smp])
            ->andFilterWhere(['like', 'no_seri_skhun_smp', $this->no_seri_skhun_smp])
            ->andFilterWhere(['like', 'no_ujian_nasional', $this->no_ujian_nasional])
            ->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'kelurahan', $this->kelurahan])
            ->andFilterWhere(['like', 'kecamatan', $this->kecamatan])
            ->andFilterWhere(['like', 'kota', $this->kota])
            ->andFilterWhere(['like', 'provinsi', $this->provinsi])
            ->andFilterWhere(['like', 'transportasi', $this->transportasi])
            ->andFilterWhere(['like', 'tlp_rumah', $this->tlp_rumah])
            ->andFilterWhere(['like', 'hp', $this->hp])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'status_kps', $this->status_kps])
            ->andFilterWhere(['like', 'no_kps', $this->no_kps])
            ->andFilterWhere(['like', 'user_create', $this->user_create])
            ->andFilterWhere(['like', 'user_update', $this->user_update]);

        return $dataProvider;
    }
}
