<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan".
 *
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
 * @property int $urutan
 */
class Tagihan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtagihan', 'idcabang', 'idkategori', 'tahun_ajaran', 'seragam', 'peralatan', 'uang_pangkal', 'uang_bangunan', 'material_penunjang','material_tahunan','daftar_ulang'], 'required'],
            [['idcabang', 'idkategori'], 'integer'],
            // [['seragam', 'peralatan', 'uang_pangkal', 'uang_bangunan', 'material'], 'number'],
            [['idtagihan'], 'string', 'max' => 20],
            [['tahun_ajaran'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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
            'daftar_ulang' => 'Daftar Ulang',
            'urutan' => 'Urutan',
        ];
    }
}
