<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "import".
 *
 * @property int $id
 * @property string $kategori
 * @property string $file
 * @property string $user
 * @property string $date
 */
class Import extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'import';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'required'],
            [['date'], 'safe'],
            [['kategori', 'file', 'user'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori' => 'Kategori',
            'file' => 'File',
            'user' => 'User',
            'date' => 'Date',
        ];
    }
}
