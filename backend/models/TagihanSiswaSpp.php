<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan_siswa_spp".
 *
 * @property string $idtagihan
 * @property string $kode_siswa
 * @property string $bulan
 * @property double $nominal
 * @property string $tahun_ajaran
 * @property int $flag
 * @property string $date_create
 * @property string $date_update
 * @property string $user_create
 * @property string $user_update
 * @property int $urutan
 */
class TagihanSiswaSpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan_siswa_spp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtagihan', 'kode_siswa', 'bulan', 'nominal', 'tahun_ajaran', 'flag', 'date_create', 'user_create'], 'required'],
            [['nominal'], 'number'],
            [['flag', 'urutan'], 'integer'],
            [['date_create', 'date_update'], 'safe'],
            [['idtagihan', 'kode_siswa'], 'string', 'max' => 20],
            [['bulan', 'tahun_ajaran', 'user_create', 'user_update'], 'string', 'max' => 50],
            [['idtagihan', 'kode_siswa', 'bulan'], 'unique', 'targetAttribute' => ['idtagihan', 'kode_siswa', 'bulan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtagihan' => 'Idtagihan',
            'kode_siswa' => 'Kode Siswa',
            'bulan' => 'Bulan',
            'nominal' => 'Nominal',
            'tahun_ajaran' => 'Tahun Ajaran',
            'flag' => 'Flag',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'urutan' => 'Urutan',
        ];
    }
}
