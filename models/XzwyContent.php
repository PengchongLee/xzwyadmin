<?php

namespace app\models;

use Yii;
use app\models\XzwyNav;
/**
 * This is the model class for table "xzwy_content".
 *
 * @property string $content_id
 * @property string $content_title
 * @property string $content_info
 * @property integer $look_num
 * @property string $create_time
 * @property integer $is_delete
 * @property string $update_time
 * @property integer $nav_id
 *
 * @property XzwyImg[] $xzwyImgs
 */
class XzwyContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xzwy_content';
    }


    public function getXzwy_nav()
    {
        // 参数一 关联Model名   参数二 关联字段 不能写表.t_id 自己默认后边是本Model的表id  前边是关联表的id
       return $this->hasOne(XzwyNav::className(),['nav_id'=>'nav_id']);
    }

    public function getXzwy_img()
    {
       return $this->hasOne(XzwyImg::className(),['xzwy_content_content_id'=>'content_id']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_info'], 'string'],
            [['look_num', 'is_delete', 'nav_id'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['nav_id'], 'required'],
            [['content_title'], 'string', 'max' => 90],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'content_id' => 'Content ID',
            'content_title' => 'Content Title',
            'content_info' => 'Content Info',
            'look_num' => 'Look Num',
            'create_time' => 'Create Time',
            'is_delete' => 'Is Delete',
            'update_time' => 'Update Time',
            'nav_id' => 'Nav ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXzwyImgs()
    {
        return $this->hasMany(XzwyImg::className(), ['xzwy_content_content_id' => 'content_id']);
    }
}
