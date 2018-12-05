<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property int $idkelas
 * @property string $kode
 * @property int $idajaran
 * @property string $idjurusan
 * @property string $nama_kelas
 * @property int $status
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kode', 'idajaran', 'idjurusan'], 'required'],
            [['idajaran', 'status'], 'integer'],
            [['kode', 'idjurusan'], 'string', 'max' => 10],
            [['nama_kelas'], 'string', 'max' => 50],
            [['kode', 'idajaran', 'idjurusan'], 'unique', 'targetAttribute' => ['kode', 'idajaran', 'idjurusan']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idkelas' => 'Idkelas',
            'kode' => 'Kode',
            'idajaran' => 'Idajaran',
            'idjurusan' => 'Idjurusan',
            'nama_kelas' => 'Nama Kelas',
            'status' => 'Status',
        ];
    }
}
