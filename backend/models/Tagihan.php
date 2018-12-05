<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan".
 *
 * @property string $idtagihan
 * @property string $idkelas
 * @property int $idajaran
 * @property string $idjurusan
 * @property double $administrasi
 * @property double $pengembangan
 * @property double $praktik
 * @property double $semester_a
 * @property double $semester_b
 * @property double $lab_inggris
 * @property double $lks
 * @property double $perpustakaan
 * @property double $osis
 * @property double $mpls
 * @property double $asuransi
 * @property string $user_create
 * @property string $date_create
 * @property string $user_update
 * @property string $date_update
 */
class Tagihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tagihan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtagihan', 'idkelas', 'idajaran', 'idjurusan'], 'required'],
            [['idajaran'], 'integer'],
            [['administrasi', 'pengembangan', 'praktik', 'semester_a', 'semester_b', 'lab_inggris', 'lks', 'perpustakaan', 'osis', 'mpls', 'asuransi'], 'number'],
            [['date_create', 'date_update'], 'safe'],
            [['idtagihan', 'idkelas', 'idjurusan'], 'string', 'max' => 10],
            [['user_create', 'user_update'], 'string', 'max' => 50],
            [['idtagihan', 'idkelas'], 'unique', 'targetAttribute' => ['idtagihan', 'idkelas']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idtagihan' => 'Idtagihan',
            'idkelas' => 'Idkelas',
            'idajaran' => 'Idajaran',
            'idjurusan' => 'Idjurusan',
            'administrasi' => 'Administrasi',
            'pengembangan' => 'Pengembangan',
            'praktik' => 'Praktik',
            'semester_a' => 'Semester A',
            'semester_b' => 'Semester B',
            'lab_inggris' => 'Lab Inggris',
            'lks' => 'Lks',
            'perpustakaan' => 'Perpustakaan',
            'osis' => 'Osis',
            'mpls' => 'Mpls',
            'asuransi' => 'Asuransi',
            'user_create' => 'User Create',
            'date_create' => 'Date Create',
            'user_update' => 'User Update',
            'date_update' => 'Date Update',
        ];
    }
}
