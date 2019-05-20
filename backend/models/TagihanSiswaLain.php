<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan_siswa_lain".
 *
 * @property string $kode_siswa
 * @property string $kode_kelas
 * @property string $idtagihan
 * @property double $nominal
 * @property string $tahun_ajaran
 * @property string $key_
 * @property string $assign_by
 * @property string $assign_date
 * @property int $urutan
 */
class TagihanSiswaLain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan_siswa_lain';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_siswa', 'kode_kelas', 'idtagihan', 'nominal', 'tahun_ajaran', 'key_', 'assign_by', 'assign_date'], 'required'],
            [['nominal'], 'number'],
            [['assign_date'], 'safe'],
            [['kode_siswa', 'kode_kelas', 'idtagihan', 'key_'], 'string', 'max' => 20],
            [['tahun_ajaran'], 'string', 'max' => 10],
            [['assign_by'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_siswa' => 'Kode Siswa',
            'kode_kelas' => 'Kode Kelas',
            'idtagihan' => 'Idtagihan',
            'nominal' => 'Nominal',
            'tahun_ajaran' => 'Tahun Ajaran',
            'key_' => 'Key',
            'assign_by' => 'Assign By',
            'assign_date' => 'Assign Date',
            'urutan' => 'Urutan',
        ];
    }
}
