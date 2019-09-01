<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $idmenu
 * @property string $nama_menu
 * @property string $icon
 * @property string $color
 * @property string $link
 * @property int $flag
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_menu', 'icon', 'color', 'link', 'flag'], 'required'],
            [['flag'], 'integer'],
            [['nama_menu', 'icon', 'color', 'link'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idmenu' => 'Idmenu',
            'nama_menu' => 'Nama Menu',
            'icon' => 'Icon',
            'color' => 'Color',
            'link' => 'Link',
            'flag' => 'Flag',
        ];
    }
}
