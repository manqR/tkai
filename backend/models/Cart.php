<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property string $kode_siswa
 * @property string $idtagihan
 * @property string $remarks
 * @property string $keterangan
 * @property double $nominal
 * @property double $jumlah_bayar
 * @property string $tahun_ajaran
 * @property int $flag
 * @property string $date
 * @property int $urutan
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_siswa', 'idtagihan', 'remarks', 'keterangan', 'nominal', 'jumlah_bayar', 'tahun_ajaran', 'flag', 'date'], 'required'],
            [['nominal', 'jumlah_bayar'], 'number'],
            [['flag','diskon'], 'integer'],
            [['date'], 'safe'],
            [['kode_siswa', 'idtagihan', 'tahun_ajaran'], 'string', 'max' => 20],
            [['remarks', 'keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_siswa' => 'Kode Siswa',
            'idtagihan' => 'Idtagihan',
            'remarks' => 'Remarks',
            'keterangan' => 'Keterangan',
            'nominal' => 'Nominal',
            'diskon' => 'Diskon',
            'jumlah_bayar' => 'Jumlah Bayar',
            'tahun_ajaran' => 'Tahun Ajaran',
            'flag' => 'Flag',
            'date' => 'Date',
            'urutan' => 'Urutan',
        ];
    }
}
