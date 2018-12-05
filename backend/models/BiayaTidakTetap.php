<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "biaya_tidak_tetap".
 *
 * @property int $id
 * @property string $keterangan
 * @property double $nominal
 * @property string $user_created
 * @property string $date_created
 */
class BiayaTidakTetap extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'biaya_tidak_tetap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nominal'], 'number'],
            [['date_created'], 'safe'],
            [['keterangan', 'user_created'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
            'nominal' => 'Nominal',
            'user_created' => 'User Created',
            'date_created' => 'Date Created',
        ];
    }
}
