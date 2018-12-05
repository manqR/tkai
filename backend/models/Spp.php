<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "spp".
 *
 * @property int $idspp
 * @property string $idtagihan
 * @property double $besaran
 * @property string $bulan
 * @property string $user_create
 * @property string $user_update
 * @property string $date_create
 * @property string $date_update
 */
class Spp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idtagihan', 'besaran', 'bulan', 'user_create', 'date_create'], 'required'],
            [['besaran'], 'number'],
            [['date_create', 'date_update'], 'safe'],
            [['idtagihan', 'bulan', 'user_create', 'user_update'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idspp' => 'Idspp',
            'idtagihan' => 'Idtagihan',
            'besaran' => 'Besaran',
            'bulan' => 'Bulan',
            'user_create' => 'User Create',
            'user_update' => 'User Update',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
        ];
    }
}
