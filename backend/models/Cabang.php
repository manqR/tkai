<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cabang".
 *
 * @property string $keterangan
 * @property int $idcabang
 * @property string $nama_sekolah
 * @property string $alamat
 * @property string $kecamatan
 * @property string $kota
 *
 * @property Kelas[] $kelas
 * @property Siswa[] $siswas
 */
class Cabang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cabang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan'], 'required'],
            [['keterangan', 'nama_sekolah', 'alamat', 'kecamatan', 'kota'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'keterangan' => 'Keterangan',
            'idcabang' => 'Idcabang',
            'nama_sekolah' => 'Nama Sekolah',
            'alamat' => 'Alamat',
            'kecamatan' => 'Kecamatan',
            'kota' => 'Kota',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['idcabang' => 'idcabang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['idcabang' => 'idcabang']);
    }
}
