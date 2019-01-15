<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan_spp".
 *
 * @property string $idtagihan
 * @property string $bulan
 * @property double $nominal
 * @property int $urutan
 */
class TagihanSpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan_spp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtagihan', 'bulan', 'nominal'], 'required'],
            [['idtagihan'], 'string', 'max' => 20],
            [['bulan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtagihan' => 'Idtagihan',
            'bulan' => 'Bulan',
            'nominal' => 'Nominal',
            'urutan' => 'Urutan',
        ];
    }
}
