<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kode_siswa".
 *
 * @property string $kode_siswa
 * @property string $kode_kelas
 * @property string $tahun_ajaran
 * @property string $date
 * @property string $user
 * @property int $urutan
 */
class KodeSiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kode_siswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_siswa', 'kode_kelas', 'tahun_ajaran', 'date', 'user'], 'required'],
            [['date'], 'safe'],
            [['kode_siswa', 'kode_kelas', 'tahun_ajaran', 'user'], 'string', 'max' => 50],
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
            'tahun_ajaran' => 'Tahun Ajaran',
            'date' => 'Date',
            'user' => 'User',
            'urutan' => 'Urutan',
        ];
    }
}
