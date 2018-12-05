<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tahun_ajaran".
 *
 * @property int $idajaran
 * @property string $tahun_ajaran
 * @property int $status
 */
class TahunAjaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tahun_ajaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun_ajaran', 'status'], 'required'],
            [['status'], 'integer'],
            [['tahun_ajaran'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idajaran' => 'Idajaran',
            'tahun_ajaran' => 'Tahun Ajaran',
            'status' => 'Status',
        ];
    }
}
