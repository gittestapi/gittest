<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "JoinRepo".
 *
 * @property integer $id
 * @property integer $uid
 * @property integer $repoid
 * @property string $IsApproved
 * @property string $JoinDate
 */
class JoinRepo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'JoinRepo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'repoid'], 'required'],
            [['uid', 'repoid'], 'integer'],
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
            'repoid' => 'Repoid',
            'IsApproved' => 'Is Approved',
            'JoinDate' => 'Join Date',
        ];
    }
}
