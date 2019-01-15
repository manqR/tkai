<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bulan_spp".
 *
 * @property string $bulan
 * @property int $urutan
 */
class BulanSpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bulan_spp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bulan'], 'required'],
            [['bulan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bulan' => 'Bulan',
            'urutan' => 'Urutan',
        ];
    }
}
