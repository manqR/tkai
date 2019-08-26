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
 * @property string $keterangan2
 * @property double $nominal
 * @property int $diskon
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
            [['kode_siswa', 'idtagihan', 'remarks', 'keterangan', 'keterangan2', 'nominal', 'diskon', 'jumlah_bayar', 'tahun_ajaran', 'flag', 'date'], 'required'],
            [['nominal', 'jumlah_bayar'], 'number'],
            [['diskon', 'flag'], 'integer'],
            [['date'], 'safe'],
            [['kode_siswa', 'idtagihan', 'tahun_ajaran'], 'string', 'max' => 20],
            [['remarks', 'keterangan'], 'string', 'max' => 50],
            [['keterangan2'], 'string', 'max' => 255],
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
            'keterangan2' => 'Keterangan2',
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
