<?php

namespace app\models;

use Yii;
use yii\db\Expression;

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
class TestCaseResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testresult';
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
            [['gitissuelink'], 'string', 'max' => 1000],
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
            'id' => 'Trid',
            'tcid' => 'Tcid',
            'status' => 'Status',
            'whorun' => 'Whorun',
            'teid' => 'Teid',
            'gitissuelink' => 'Gitissuelink',
            'updatedate' => 'Updatedate',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            // Place your custom code here

            $this->updatedate = new Expression('NOW()');
            return true;
        } else {
            return false;
        }
    }

    public function getTestPlan() {
        return $this->hasOne(TestExcution::className(), ['id' => 'teid']);
    }

    public function getTestCase() {
        return $this->hasOne(TestCase::className(),['id' => 'tcid']);
    }

    public function getTestStepResults() {
        return $this->hasMany(TestStepResult::className(),['trid'=>'id']);
    }
}
