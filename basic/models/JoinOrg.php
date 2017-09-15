<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "JoinOrg".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $orgid
 * @property string $IsApproved
 * @property string $JoinDate
 */
class JoinOrg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'JoinOrg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'orgid'], 'required'],
            [['uid', 'orgid'], 'integer'],
            [['JoinDate'], 'safe'],
            [['IsApproved'], 'string', 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'orgid' => 'Orgid',
            'IsApproved' => 'Is Approved',
            'JoinDate' => 'Join Date',
        ];
    }
}
