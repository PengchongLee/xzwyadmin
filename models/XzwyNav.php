<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "xzwy_nav".
 *
 * @property string $nav_id
 * @property string $nav_name
 * @property integer $is_delete
 * @property integer $nav_type
 * @property string $create_time
 * @property string $update_time
 * @property string $nav_link
 */
class XzwyNav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xzwy_nav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_delete', 'nav_type'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['nav_name'], 'string', 'max' => 45],
            [['nav_link'], 'string', 'max' => 90],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nav_id' => 'Nav ID',
            'nav_name' => 'Nav Name',
            'is_delete' => 'Is Delete',
            'nav_type' => 'Nav Type',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'nav_link' => 'Nav Link',
        ];
    }
}
