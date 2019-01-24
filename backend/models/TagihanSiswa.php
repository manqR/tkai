<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan_siswa".
 *
 * @property string $kode_siswa
 * @property string $kode_kelas
 * @property string $idtagihan
 * @property int $idcabang
 * @property int $idkategori
 * @property string $tahun_ajaran
 * @property double $seragam
 * @property double $peralatan
 * @property double $uang_pangkal
 * @property double $uang_bangunan
 * @property double $material_penunjang
 * @property double $material_tahunan
 * @property string $tanggal_assign
 * @property string $user_assign
 * @property int $urutan
 */
class TagihanSiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan_siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_siswa', 'kode_kelas', 'idtagihan', 'idcabang', 'idkategori', 'tahun_ajaran', 'seragam', 'peralatan', 'uang_pangkal', 'uang_bangunan', 'material_penunjang', 'material_tahunan', 'tanggal_assign', 'user_assign'], 'required'],
            [['idcabang', 'idkategori'], 'integer'],
            [['seragam', 'peralatan', 'uang_pangkal', 'uang_bangunan', 'material_penunjang', 'material_tahunan'], 'number'],
            [['tanggal_assign'], 'safe'],
            [['kode_siswa', 'idtagihan', 'tahun_ajaran'], 'string', 'max' => 20],
            [['kode_kelas'], 'string', 'max' => 10],
            [['user_assign'], 'string', 'max' => 50],
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
            'idcabang' => 'Idcabang',
            'idkategori' => 'Idkategori',
            'tahun_ajaran' => 'Tahun Ajaran',
            'seragam' => 'Seragam',
            'peralatan' => 'Peralatan',
            'uang_pangkal' => 'Uang Pangkal',
            'uang_bangunan' => 'Uang Bangunan',
            'material_penunjang' => 'Material Penunjang',
            'material_tahunan' => 'Material Tahunan',
            'tanggal_assign' => 'Tanggal Assign',
            'user_assign' => 'User Assign',
            'urutan' => 'Urutan',
        ];
    }
}
