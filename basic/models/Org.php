<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "Org".
 *
 * @property integer $orgid
 * @property string $orgname
 * @property integer $adminid
 * @property string $RegisterDate
 */
class Org extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['adminid'], 'required'],
            [['adminid'], 'integer'],
			['orgname', 'unique', 'message' => "This org name already exists."],
            [['RegisterDate'], 'safe'],
            [['orgname'], 'string', 'max' => 300],
			['orgname', 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'orgid' => 'Orgid',
            'orgname' => 'Orgname',
            'adminid' => 'Adminid',
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
}
