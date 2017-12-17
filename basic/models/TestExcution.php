<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "TestExcution".
 *
 * @property integer $teid
 * @property string $tename
 * @property string $milestone
 * @property string $CreateDate
 */
class TestExcution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testexcution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CreateDate'], 'safe'],
            [['name', 'milestone'], 'string', 'max' => 300],
            ['uid','integer'],
            ['designCompleted','boolean'],
            ['tcids','string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Teid',
            'name' => 'Tename',
            'milestone' => 'Milestone',
            'CreateDate' => 'Create Date',
        ];
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // ...custom code here...
        $this->CreateDate = new Expression('NOW()');

        return true;
    }

    /**
    * 返回当前的 TestCase ids 数组
    */
    public function getTCIDs()
    {
        $tcidArray = json_decode($this->tcids);
        if (is_null($tcidArray) || empty($tcidArray)) {
            $tcidArray = array();
        }
        return $tcidArray;
    }

    public function insertTCs($tcids)
    {
        $tcidArray = $this->TCIDs;
        foreach($tcids as $tcid) {
            if (!in_array($tcid,$tcidArray)) {
                array_push($tcidArray,$tcid);
            }
        }
        $this->tcids = json_encode($tcidArray);
        $this->save();
    }

    public function getTestCaseResults()
    {
        return $this->hasMany(TestCaseResult::className(),['teid'=>'id']);
    }
}
