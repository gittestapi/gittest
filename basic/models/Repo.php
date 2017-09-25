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
        return 'Repo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['reponame', 'unique', 'message' => "This org name already exists."],
            [['reponame'], 'string', 'max' => 300],
            [['reponame','ishide'],'required'],
            [['ishide'], YONValidator::className()],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'repoid' => 'Repoid',
            'reponame' => 'Reponame',
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
        return $this->hasOne(User::className(),['uid'=>'adminid']);
    }
}
