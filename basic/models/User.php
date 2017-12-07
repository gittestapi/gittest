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

    /**
     * 返回用户参与的 repos
     * @return array 键为 repo 的 id，值为 repo 的 name
     */
    public function getRepoNames($role=null) //原来的命名不规范且占用了 'getRepos（）' 约定功能
    {
        $cond = ['uid'=>$this->id];
        if (!is_null($role) && in_array(strtoupper($role),['M','E'])) {
            $cond['role'] = strtoupper($role);
        }
        $joinrepos = JoinRepo::find()->where($cond)
                    ->select(['repoid'])->all();
        $reponames = [];
        foreach($joinrepos as $item) {
            $repo = Repo::findOne($item->repoid);
            if ($repo) {
                $reponames[$repo->id] = $repo->name;
            }
        }
        return $reponames;
    }

    public function getJoinRepos()
    {
        return $this->hasMany(JoinRepo::className(),['uid'=>'id']);
    }

    /*
    ** 当前用户参与的项目
    *  @param string $role 用户在项目中的角色
    */
    public function getRepos($role=null)
    {
        if (!is_null($role) && in_array(strtoupper($role),['M','E'])) {
            $role = strtoupper($role);
            return $this->hasMany(Repo::className(),['id'=>'repoid'])->via('joinRepos',function($query) use ($role) {$query->where(['role'=>$role]);});
        } else {
            return $this->hasMany(Repo::className(),['id'=>'repoid'])->via('joinRepos');
        }
    }
}
