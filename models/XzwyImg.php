<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "xzwy_img".
 *
 * @property string $img_id
 * @property string $img_path
 * @property string $xzwy_content_content_id
 *
 * @property XzwyContent $xzwyContentContent
 */
class XzwyImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'xzwy_img';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['xzwy_content_content_id'], 'required'],
            [['xzwy_content_content_id'], 'integer'],
            [['img_path'], 'string', 'max' => 45],
            [['xzwy_content_content_id'], 'exist', 'skipOnError' => true, 'targetClass' => XzwyContent::className(), 'targetAttribute' => ['xzwy_content_content_id' => 'content_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'img_id' => 'Img ID',
            'img_path' => 'Img Path',
            'xzwy_content_content_id' => 'Xzwy Content Content ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getXzwyContentContent()
    {
        return $this->hasOne(XzwyContent::className(), ['content_id' => 'xzwy_content_content_id']);
    }
}
