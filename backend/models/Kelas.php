<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property string $kode
 * @property int $idkategori
 * @property int $idcabang
 * @property string $tahun_ajaran
 * @property string $wali_kelas
 * @property string $guru_kelas
 * @property int $flag
 * @property string $key_
 * @property int $urutan
 *
 * @property Cabang $cabang
 * @property Kategori $kategori
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'idkategori', 'idcabang', 'tahun_ajaran', 'key_'], 'required'],
            [['idkategori', 'idcabang', 'flag'], 'integer'],
            [['kode'], 'string', 'max' => 10],
            [['tahun_ajaran', 'wali_kelas', 'guru_kelas'], 'string', 'max' => 50],
            [['key_'], 'string', 'max' => 20],
            [['idcabang'], 'exist', 'skipOnError' => true, 'targetClass' => Cabang::className(), 'targetAttribute' => ['idcabang' => 'idcabang']],
            [['idkategori'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::className(), 'targetAttribute' => ['idkategori' => 'idkategori']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'idkategori' => 'Idkategori',
            'idcabang' => 'Idcabang',
            'tahun_ajaran' => 'Tahun Ajaran',
            'wali_kelas' => 'Wali Kelas',
            'guru_kelas' => 'Guru Kelas',
            'flag' => 'Flag',
            'key_' => 'Key',
            'urutan' => 'Urutan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCabang()
    {
        return $this->hasOne(Cabang::className(), ['idcabang' => 'idcabang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['idkategori' => 'idkategori']);
    }
}
