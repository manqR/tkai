<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property int $idcart
 * @property string $idsiswa
 * @property string $key_
 * @property string $idkelas
 * @property string $keterangan
 * @property double $nominal
 * @property int $flag
 * @property string $user_create
 * @property string $date_create
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idsiswa', 'key_', 'idkelas', 'keterangan', 'nominal', 'flag', 'user_create', 'date_create'], 'required'],
            [['nominal'], 'number'],
            [['flag'], 'integer'],
            [['date_create'], 'safe'],
            [['idsiswa'], 'string', 'max' => 10],
            [['key_', 'idkelas', 'keterangan', 'user_create'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idcart' => 'Idcart',
            'idsiswa' => 'Idsiswa',
            'key_' => 'Key',
            'idkelas' => 'Idkelas',
            'keterangan' => 'Keterangan',
            'nominal' => 'Nominal',
            'flag' => 'Flag',
            'user_create' => 'User Create',
            'date_create' => 'Date Create',
        ];
    }
}
