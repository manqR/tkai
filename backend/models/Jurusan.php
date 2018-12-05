<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "jurusan".
 *
 * @property string $idjurusan
 * @property string $nama_jurusan
 */
class Jurusan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jurusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idjurusan'], 'required'],
            [['idjurusan'], 'string', 'max' => 10],
            [['nama_jurusan'], 'string', 'max' => 50],
            [['idjurusan'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idjurusan' => 'Idjurusan',
            'nama_jurusan' => 'Nama Jurusan',
        ];
    }
}
