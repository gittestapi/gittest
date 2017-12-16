<?php

namespace app\models;

use Yii;
use yii\db\Expression;

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
class TestStepResult extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'teststepresult';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sid', 'trid'], 'required'],
            [['sid', 'trid'], 'integer'],
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
            'trid' => 'Trid',
            'content' => 'Content',
            'status' => 'Status',
            'whorun' => 'Whorun',
            'updatedate' => 'Updatedate',
        ];
    }

    public function beforeSave($insert) {
		if (parent::beforeSave($insert)) {
            // ...custom code here...
			$this->updatedate = new Expression('NOW()');
			return true;
		} else {
			return false;
		}
	}

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        
        // 根据 teststepresult 的 siblings 的情况来决定 testcaseresult 的 status 的值
        $testCaseResult = $this->testCaseResult;
        $testCaseResult->status = 's'; // 默认为 's'，具体取值还要下面的 for 循环判断
        $siblings = $testCaseResult->testStepResults;
        for($i=0;$i<count($siblings);$i++)
        {
            $status = $siblings[$i]->status;
            if (is_null($status) || empty($status)) { // stepresult 的 status 为 null 时，testCaseResult 的 status 也为 null
                $testCaseResult->status = null;
                continue;
            }
            if ($status === 'f') { // stepresult 的 status 为 'f' 时，testCaseResult 的 status 也为 'f'
                $testCaseResult->status = $status;
                break;
            }
        }
        $testCaseResult->save(false);
    }

    public function getTestCaseResult()
    {
        return $this->hasOne(TestCaseResult::className(),['id'=>'trid']);
    }

    public function getTestStep()
    {
        return $this->hasOne(Step::className(),['id'=>'sid']);
    }
}
