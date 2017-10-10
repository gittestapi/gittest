<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "TestCase".
 *
 * @property integer $tcid
 * @property string $tctitle
 * @property integer $priority
 * @property integer $serverity
 * @property integer $repoid
 * @property string $area
 * @property string $category
 * @property string $tag
 * @property string $CreateDate
 */
class TestCase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TestCase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['priority', 'serverity', 'repoid'], 'required'],
            [['priority', 'serverity', 'repoid'], 'integer'],
            [['CreateDate'], 'safe'],
            [['title'], 'string', 'max' => 1000],
            [['area', 'category', 'tag'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Tcid',
            'title' => 'Tctitle',
            'priority' => 'Priority',
            'serverity' => 'Serverity',
            'repoid' => 'Repo',
            'area' => 'Area',
            'category' => 'Category',
            'tag' => 'Tag',
            'CreateDate' => 'Create Date',
        ];
    }
	
	public function beforeSave($insert) {	
		if (parent::beforeSave($insert)) {
			// Place your custom code here
			
			$this->CreateDate = new Expression('NOW()');
			return true;
		} else {
			return false;
		}
	}

    public function getRepo()
    {
        return $this->hasOne(Repo::className(),['repoid'=>'repoid']);
    }


    /**
     *
     */
    protected function getStepIDS()
    {
        $rows =  Steps::find()->select(['sid'])
                    ->where(['tcid'=>$this->tcid])
                    ->asArray()
                    ->all();  
        $ids = [];
        foreach($rows as $r){
            array_push($ids,$r['sid']);
        }
        return $ids;       
    }

    /**
     * 为测试计划生成对应的 TestResult 和 TestStepResult
     * @param integer $teid 测试计划 ID
     */
    public function initTestResult($teid)
    {
        $testResult = new TestResult([
            'tcid' => $this->tcid,
            'tctitle' => $this->tctitle,
            'status' => '',
            'teid' => $teid,
            ]);
        if($testResult->validate()) {
            $testResult->save(false);
        }else{
            Yii::warning($testResult->errors);
        }

        $stepids = $this->getStepIDS();
        foreach($stepids as $sid) {
            $tsr = new TestStepsResult([
                'sid' => $sid, // 测试步骤编号
                'tcid' => $this->tcid,
                'trid' => $testResult->trid,
                'status' => '',
                ]);
            if($tsr->validate()){
                $tsr->save(false);
            }else{
                Yii::warning($tsr->errors);
            }
            
        }
    }
}
