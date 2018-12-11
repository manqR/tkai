<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tahun_ajaran".
 *
 * @property int $idtahun_ajaran
 * @property string $tahun_ajaran
 * @property int $flag
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun_ajaran', 'flag'], 'required'],
            [['flag'], 'integer'],
            [['tahun_ajaran'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtahun_ajaran' => 'Idtahun Ajaran',
            'tahun_ajaran' => 'Tahun Ajaran',
            'flag' => 'Flag',
        ];
    }
}
