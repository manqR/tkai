<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property int $bank_code
 * @property string $bank_name
 * @property int $flag
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_name', 'flag'], 'required'],
            [['flag'], 'integer'],
            [['bank_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bank_code' => 'Bank Code',
            'bank_name' => 'Bank Name',
            'flag' => 'Flag',
        ];
    }
}
