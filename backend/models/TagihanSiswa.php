<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan_siswa".
 *
 * @property int $idtagihan_siswa
 * @property string $idsiswa
 * @property int $idgroup
 * @property string $nama_tagihan
 * @property double $besaran
 * @property string $keterangan
 * @property string $user_create
 * @property string $date_create
 */
class TagihanSiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tagihan_siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'idgroup', 'nama_tagihan', 'besaran', 'user_create', 'date_create'], 'required'],
            [['idgroup'], 'integer'],
            [['besaran'], 'number'],
            [['keterangan'], 'string'],
            [['date_create'], 'safe'],
            [['idsiswa'], 'string', 'max' => 10],
            [['nama_tagihan', 'user_create'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtagihan_siswa' => 'Idtagihan Siswa',
            'idsiswa' => 'Idsiswa',
            'idgroup' => 'Idgroup',
            'nama_tagihan' => 'Nama Tagihan',
            'besaran' => 'Besaran',
            'keterangan' => 'Keterangan',
            'user_create' => 'User Create',
            'date_create' => 'Date Create',
        ];
    }
}
