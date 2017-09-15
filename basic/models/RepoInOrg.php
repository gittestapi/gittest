<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "RepoInOrg".
 *
 * @property integer $id
 * @property integer $repoid
 * @property integer $orgid
 * @property string $CreateDate
 */
class RepoInOrg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'RepoInOrg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repoid', 'orgid'], 'required'],
            [['repoid', 'orgid'], 'integer'],
            [['CreateDate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'repoid' => 'Repoid',
            'orgid' => 'Orgid',
            'CreateDate' => 'Create Date',
        ];
    }
}
