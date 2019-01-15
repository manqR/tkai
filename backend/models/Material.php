<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property string $nama
 * @property string $keterangan
 * @property int $urutan
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'material';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'keterangan'], 'required'],
            [['nama', 'keterangan'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nama' => 'Nama',
            'keterangan' => 'Keterangan',
            'urutan' => 'Urutan',
        ];
    }
}
