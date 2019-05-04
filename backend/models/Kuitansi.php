<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kuitansi".
 *
 * @property string $no_kuitansi
 * @property int $idcart
 * @property string $kode_siswa
 * @property string $idtagihan
 * @property string $remarks
 * @property string $keterangan
 * @property double $nominal
 * @property double $jumlah_bayar
 * @property string $tahun_ajaran
 * @property int $flag
 * @property string $payment_method
 * @property string $date
 * @property int $urutan
 */
class Kuitansi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kuitansi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_kuitansi', 'idcart', 'kode_siswa', 'idtagihan', 'remarks', 'keterangan', 'nominal', 'jumlah_bayar', 'tahun_ajaran', 'flag', 'payment_method', 'date'], 'required'],
            [['idcart', 'flag'], 'integer'],
            [['nominal', 'jumlah_bayar'], 'number'],
            [['date'], 'safe'],
            [['no_kuitansi', 'bank_name','kode_siswa', 'idtagihan', 'remarks', 'keterangan', 'tahun_ajaran', 'payment_method'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_kuitansi' => 'No Kuitansi',
            'idcart' => 'Idcart',
            'kode_siswa' => 'Kode Siswa',
            'idtagihan' => 'Idtagihan',
            'remarks' => 'Remarks',
            'keterangan' => 'Keterangan',
            'nominal' => 'Nominal',
            'jumlah_bayar' => 'Jumlah Bayar',
            'tahun_ajaran' => 'Tahun Ajaran',
            'flag' => 'Flag',
            'payment_method' => 'Payment Method',
            'bank_name' => 'Bank Name',
            'date' => 'Date',
            'urutan' => 'Urutan',
        ];
    }
}
