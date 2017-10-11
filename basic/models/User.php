<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "User".
 *
 * @property integer $uid
 * @property string $uname
 * @property string $passwd
 * @property string $email
 * @property string $RegisterDate
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
		    ['name', 'unique', 'message' => "This user's name already exists."],
			['email', 'unique', 'message' => "This user's email already exists."],
		    [['name', 'passwd', 'email'], 'required'],
            [['name', 'passwd', 'email'], 'string', 'max' => 300],
			['email', 'email'],
			[['name', 'email'], 'trim'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Userid',
            'name' => 'Username',
            'passwd' => 'Password',
            'email' => 'Email Address',
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
	
	public static function findIdentity($id)
    {
        return new static(User::findOne($id));
    }
	
	public static function findIdentityByAccessToken($token, $type = null)
    {
        return new static(User::findOne($id));
    }
	
	/**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->id === $authKey;
    }
	
	public function validatePassword($password)
    {
        return $this->passwd === $password;
    }
}
