<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "agama".
 *
 * @property string $keterangan
 * @property int $idagama
 */
class Agama extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agama';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan'], 'required'],
            [['keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'keterangan' => 'Keterangan',
            'idagama' => 'Idagama',
        ];
    }
}
