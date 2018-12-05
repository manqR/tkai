<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pencatatan_keuangan".
 *
 * @property int $idcatat
 * @property string $no_pencatatan
 * @property string $kategori
 * @property string $keterangan
 * @property double $nominal
 * @property int $flag
 * @property string $user_create
 * @property string $date_create
 */
class PencatatanKeuangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pencatatan_keuangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_pencatatan', 'kategori', 'keterangan', 'nominal', 'flag', 'user_create', 'date_create'], 'required'],
            [['nominal'], 'number'],
            [['flag'], 'integer'],
            [['date_create'], 'safe'],
            [['no_pencatatan'], 'string', 'max' => 10],
            [['kategori', 'keterangan', 'user_create'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcatat' => 'Idcatat',
            'no_pencatatan' => 'No Pencatatan',
            'kategori' => 'Kategori',
            'keterangan' => 'Keterangan',
            'nominal' => 'Nominal',
            'flag' => 'Flag',
            'user_create' => 'User Create',
            'date_create' => 'Date Create',
        ];
    }
}
