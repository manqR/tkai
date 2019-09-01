<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu_detail".
 *
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $link
 * @property int $flag
 */
class MenuDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'name', 'link'], 'required'],
            [['parent_id', 'flag'], 'integer'],
            [['name', 'link'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'link' => 'Link',
            'flag' => 'Flag',
        ];
    }
}
