<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kategori".
 *
 * @property string $keterangan
 * @property int $idkategori
 *
 * @property Kelas[] $kelas
 * @property Siswa[] $siswas
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan'], 'required'],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'keterangan' => 'Keterangan',
            'idkategori' => 'Idkategori',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasMany(Kelas::className(), ['idkategori' => 'idkategori']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSiswas()
    {
        return $this->hasMany(Siswa::className(), ['idkategori' => 'idkategori']);
    }
}
