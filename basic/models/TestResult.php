<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TestResult".
 *
 * @property integer $trid
 * @property integer $tcid
 * @property string $tctitle
 * @property string $status
 * @property string $whorun
 * @property integer $teid
 * @property string $gitissuelink
 * @property string $updatedate
 */
class TestResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TestResult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tcid', 'teid'], 'required'],
            [['tcid', 'teid'], 'integer'],
            [['updatedate'], 'safe'],
            [['tctitle', 'gitissuelink'], 'string', 'max' => 1000],
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
            'trid' => 'Trid',
            'tcid' => 'Tcid',
            'tctitle' => 'Tctitle',
            'status' => 'Status',
            'whorun' => 'Whorun',
            'teid' => 'Teid',
            'gitissuelink' => 'Gitissuelink',
            'updatedate' => 'Updatedate',
        ];
    }
}
