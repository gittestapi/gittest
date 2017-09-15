<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TestStepsResult".
 *
 * @property integer $id
 * @property integer $sid
 * @property integer $tcid
 * @property integer $trid
 * @property string $content
 * @property string $status
 * @property string $whorun
 * @property string $updatedate
 */
class TestStepsResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TestStepsResult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'tcid', 'trid'], 'required'],
            [['sid', 'tcid', 'trid'], 'integer'],
            [['updatedate'], 'safe'],
            [['content'], 'string', 'max' => 1000],
            [['status'], 'string', 'max' => 4],
            [['whorun'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sid' => 'Sid',
            'tcid' => 'Tcid',
            'trid' => 'Trid',
            'content' => 'Content',
            'status' => 'Status',
            'whorun' => 'Whorun',
            'updatedate' => 'Updatedate',
        ];
    }
}
