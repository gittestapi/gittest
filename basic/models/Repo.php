<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use app\components\validators\YONValidator;

/**
 * This is the model class for table "Repo".
 *
 * @property integer $repoid
 * @property string $reponame
 * @property integer $adminid
 * @property string $ishide
 * @property string $RegisterDate
 */
class Repo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'unique', 'message' => "This org name already exists."],
            [['name'], 'string', 'max' => 300],
            [['name','ishide'],'required'],
            [['ishide'], YONValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Repoid',
            'name' => 'Reponame',
            'ishide' => 'Ishide',
            'RegisterDate' => 'Register Date',
        ];
    }
	
	public function beforeSave($insert) {	
		if (parent::beforeSave($insert)) {
			// Place your custom code here
			
			$this->RegisterDate = new Expression('NOW()');
			return true;
		} else {
			return false;
		}
	}

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'adminid']);
    }

    public function getTestManagers()
    {
        $joinRepos = JoinRepo::find()->where([
            'repoid'=>$this->id,
            'role' => 'M'
            ])->andWhere(['not',['uid'=>$this->adminid]])
            ->all();

        $managers = [];
        foreach($joinRepos as $j) {
            array_push($managers,$j->tester);
        }
        return $managers;
    }

    public function getTesters()
    {
        $joinRepos = JoinRepo::find()->where([
            'repoid'=>$this->id,
            'role' => 'E'
            ])->all();

        $executers = [];
        foreach($joinRepos as $j) {
            array_push($executers,$j->tester);
        }
        return $executers;        
    }

    /**
     * 检查 Repo 是否与一个用户相关
     * @param integer $uid 用户ID
     * @return Boolean
     */
    public function isRelevantForUser($uid)
    {
        if ($this->adminid == $uid)
            return True;
        if (JoinRepo::findOne(['uid'=>$uid,'repoid'=>$this->id])) {
            return True;
        }
        return False;
    }

    /**
     * 判断一个用户是否是 repo 的测试管理员
     */
    public function isTestManagerForUser($uid)
    {
        if (JoinRepo::findOne(['uid'=>$uid,'repoid'=>$this->id,'role'=>'M']))
            return True;
        return False;
    }

    public function isTesterForUser($uid)
    {
        if (JoinRepo::findOne(['uid'=>$uid,'repoid'=>$this->id,'role'=>'M']))
            return True;
        return False;
    }
}
