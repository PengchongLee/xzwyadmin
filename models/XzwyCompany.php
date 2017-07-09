<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "xzwy_company".
 *
 * @property string $com_id
 * @property string $com_name
 * @property string $com_tel
 * @property string $com_email
 * @property string $com_address
 * @property string $com_account
 * @property string $com_intro
 * @property integer $look_num
 * @property string $create_time
 * @property string $update_time
 * @property string $web_address
 * @property string $com_fax
 * @property string $com_logo
 */
class XzwyCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xzwy_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['com_intro'], 'string'],
            [['look_num'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['com_name', 'com_address'], 'string', 'max' => 100],
            [['com_tel'], 'string', 'max' => 11],
            [['com_email', 'com_account'], 'string', 'max' => 45],
            [['web_address', 'com_fax'], 'string', 'max' => 90],
            [['com_logo'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'com_name' => 'Com Name',
            'com_tel' => 'Com Tel',
            'com_email' => 'Com Email',
            'com_address' => 'Com Address',
            'com_account' => 'Com Account',
            'com_intro' => 'Com Intro',
            'look_num' => 'Look Num',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'web_address' => 'Web Address',
            'com_fax' => 'Com Fax',
            'com_logo' => 'Com Logo',
        ];
    }
}
