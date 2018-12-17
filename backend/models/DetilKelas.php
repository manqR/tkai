<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detil_kelas".
 *
 * @property string $key_
 * @property string $kode_siswa
 */
class DetilKelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detil_kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['key_', 'kode_siswa'], 'required'],
            [['key_', 'kode_siswa'], 'string', 'max' => 20],
            [['key_', 'kode_siswa'], 'unique', 'targetAttribute' => ['key_', 'kode_siswa']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'key_' => 'Key',
            'kode_siswa' => 'Kode Siswa',
        ];
    }
}
