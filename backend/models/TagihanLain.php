<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tagihan_lain".
 *
 * @property string $idtagihan
 * @property string $nama_tagihan
 * @property double $nominal
 * @property string $created_by
 * @property string $created_date
 * @property int $urutan
 */
class TagihanLain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tagihan_lain';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idtagihan', 'nama_tagihan', 'nominal', 'created_by', 'created_date'], 'required'],
            [['created_date'], 'safe'],
            [['idtagihan'], 'string', 'max' => 20],
            [['nama_tagihan', 'created_by'], 'string', 'max' => 50],
            [['idtagihan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idtagihan' => 'Idtagihan',
            'nama_tagihan' => 'Nama Tagihan',
            'nominal' => 'Nominal',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'urutan' => 'Urutan',
        ];
    }
}
