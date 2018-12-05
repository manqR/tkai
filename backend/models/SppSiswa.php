<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spp_siswa".
 *
 * @property int $idtagihan_siswa
 * @property string $idsiswa
 * @property int $idgroup
 * @property string $bulan
 * @property double $besaran
 * @property string $user_create
 * @property string $date_create
 */
class SppSiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spp_siswa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'idgroup', 'bulan', 'besaran', 'user_create', 'date_create'], 'required'],
            [['idtagihan_siswa', 'idgroup'], 'integer'],
            [['besaran'], 'number'],
            [['date_create'], 'safe'],
            [['idsiswa'], 'string', 'max' => 10],
            [['bulan', 'user_create'], 'string', 'max' => 50],
            [['idtagihan_siswa', 'idsiswa'], 'unique', 'targetAttribute' => ['idtagihan_siswa', 'idsiswa']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtagihan_siswa' => 'Idtagihan Siswa',
            'idsiswa' => 'Idsiswa',
            'idgroup' => 'Idgroup',
            'bulan' => 'Bulan',
            'besaran' => 'Besaran',
            'user_create' => 'User Create',
            'date_create' => 'Date Create',
        ];
    }
}
