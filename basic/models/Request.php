<?php
namespace app\models;

use app\models\Repo;
use app\models\JoinRepo;
use yii\db\Expression;

class Request extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'request';
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // ...custom code here...
        if ($insert) {
            $this->created_at = new Expression('NOW()');
        } else {
            $this->afterHandle();
        }
        return true;
    }   

    public function requestMessage()
    {
    	// 申请人
    	$user = User::findOne($this->applicantID);
    	// 项目
    	$repo = Repo::findOne($this->repoID);

    	$message = MessageTemplate::RQTP[$this->mtID];
    	$message = str_replace(['{a}','{r}'],[$user->uname,$repo->reponame],$message);

    	return $message;
    }

    /**
    *  处理请求后后续处理
     */
    protected function afterHandle()
    {       
        if (strtolower($this->isApproved) == 'y') { // 如果请求批准了，把新的关系加入到表 joinreqo
            $repoID = $this->repoID;
            // repo 创建者 id
            $adminID = $this->repo->adminid;
            // 参加 repo 的用户 id
            $partnerID = $this->applicantID == $adminID ? $this->approverID : $this->applicantID;

            $joinRepo = new JoinRepo([
                'uid'=>$partnerID,
                'repoid'=>$repoID,
                'IsApproved'=>'y',
                'role'=>$this->role,
                ]);
            $joinRepo->save();
        } elseif(strtolower($this->isApproved) == 'n') { // 请求被否决
            ;// 或许给请求的发送者回馈点信息，比较好
            
        }
        $this->delete(); // 删除请求信息
    }

    public function getRepo()
    {
        return $this->hasOne(Repo::className(),['repoid'=>'repoID']);
    }	
}