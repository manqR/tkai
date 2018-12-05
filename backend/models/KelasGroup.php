<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kelas_group".
 *
 * @property int $idgroup
 * @property string $idkelas
 * @property string $wali_kelas
 * @property string $status
 */
class KelasGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kelas_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idkelas', 'wali_kelas', 'status'], 'required'],
            [['status'], 'string'],
            [['idkelas'], 'string', 'max' => 10],
            [['wali_kelas'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idgroup' => 'Idgroup',
            'idkelas' => 'Idkelas',
            'wali_kelas' => 'Wali Kelas',
            'status' => 'Status',
        ];
    }
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['idkelas' => 'idkelas']);
    }
}
