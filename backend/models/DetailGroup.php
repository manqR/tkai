<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_group".
 *
 * @property int $id
 * @property int $idgroup
 * @property string $idsiswa
 */
class DetailGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idgroup', 'idsiswa'], 'required'],
            [['idgroup'], 'integer'],
            [['idsiswa'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idgroup' => 'Idgroup',
            'idsiswa' => 'Idsiswa',
        ];
    }
	
	public function getKelasGroup()
    {
        return $this->hasOne(KelasGroup::className(), ['idgroup' => 'idgroup']);
    }
}
