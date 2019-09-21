<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "kas".
 *
 * @property int $idkas
 * @property double $nominal
 * @property string $last_update
 * @property string $update_by
 */
class Kas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nominal'], 'required'],
            [['last_update'], 'safe'],
            [['update_by'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idkas' => 'Idkas',
            'nominal' => 'Nominal',
            'last_update' => 'Last Update',
            'update_by' => 'Update By',
        ];
    }
}
