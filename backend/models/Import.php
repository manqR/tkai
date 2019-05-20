<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "import".
 *
 * @property string $filename
 * @property int $count
 * @property string $import_by
 * @property string $import_date
 * @property int $urutan
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
            [['filename', 'count', 'import_by', 'import_date'], 'required'],
            [['count'], 'integer'],
            [['import_date'], 'safe'],
            [['filename', 'import_by'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'filename' => 'Filename',
            'count' => 'Count',
            'import_by' => 'Import By',
            'import_date' => 'Import Date',
            'urutan' => 'Urutan',
        ];
    }
}
