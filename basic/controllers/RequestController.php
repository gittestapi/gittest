<?php
namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Repo;
use app\models\Request;
use app\models\JoinRepo;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class RequestController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'apply-join-in' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['apply-join-in',],
                'rules' => [
                    [
                        'actions' => ['apply-join-in',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]            
            ];
    }

    /**
     * 申请加入项目
     */
	public function actionApplyJoinIn()
	{   
        $data = ['success' => False];

        $yiiRequest = Yii::$app->request;
        $repoID = $yiiRequest->post('repoid');
        if (is_null($repoID)) {
            $data['message'] = "缺少必要的变量";
            return $this->asJson($data);
        }
        

        $repo = Repo::findOne($repoID);
        // 如果 Repo 不存在或者私有，则不能申请
        if (is_null($repo) || strtolower($repo->ishide) == 'y') { 
            $data['message'] = "项目不存在或者私有";
            return $this->asJson($data);
        }

        // 
        if ($repo->adminid == Yii::$app->user->id) {
            $data['message'] = "当前项目的创建者即为当前用户，不可申请";
            return $this->asJson($data);
        }

        if (JoinRepo::findOne(['uid' => Yii::$app->user->id,'repoid' => $repoID])) {
            $data['message'] = "当前用户已经加入了项目，不必申请";
            return $this->asJson($data);
        }

        // 如果已经申请
        if (\app\models\Request::findOne(['applicantID'=>Yii::$app->user->id,'repoID'=>$repoID])) {
            $data['message'] = 'Already submited request!';
            return $this->asJson($data);
        } else {
            $model = new \app\models\Request([
                'applicantID'=>Yii::$app->user->id,
                'approverID'=>$repo->adminid,
                'repoID'=>$repoID,
                'mtID'=>0,
                ]);
            if ($model->save()) {
                $data['success'] = True;
                $data['message'] = "成功发出请求";
                return $this->asJson($data);
            }                          
        }

        return $this->asJson([
            'success' => False,
            'message' => 'other errors!'
        ]);
	}

    /**
     * Repo 所有者同意他人加入此 Repo ，或者拒绝
     */
    public function actionHandleJoinIn()
    {
        $data = ['success' => True];

        $yiiRequest = Yii::$app->request; 
        $rid = $yiiRequest->post('rid');
        $approved = $yiiRequest->post('approved'); 
        $role = $yiiRequest->post('role','E');

        if(is_null($rid) || is_null($approved)) {
            $data['success'] = False;
            $data['message'] = "缺乏必要的变量";
            return $this->asJson($data);            
        }
             
        $request = Request::findOne($rid);

        if ($approved) {
            $request->role = $role;
            $request->isApproved = 'y';           
            $data['message'] = sprintf('Approve to join repo %s，its role is %s',$request->repo->reponame,$role);
        } else {
            $request->isApproved = 'n';
            $data['message'] = sprintf('Reject to join repo %s',$request->repo->reponame);
        }

        if($request->save()) {
            return $this->asJson($data);
        } else {
            return $this->asJson(['success'=>False,'message'=>'internal join error!']);
        }       
    }    

    /**
     * 项目所有者邀请他人加入项目
     */
    public function actionInvite()
    {
        $data = [
            'success' => False,
        ];

        $yiiRequest = Yii::$app->request; 

        // 三个必要的变量
        $repoid = $yiiRequest->post('repoid');
        $uname = $yiiRequest->post('uname');
        $role = $yiiRequest->post('role');

        if(is_null($repoid) || is_null($uname) || is_null($role)) {
            $data['message'] = "缺乏必要的变量";
            return $this->asJson($data);
        }

        // 判断邀请的用户是否存在
        $uname = trim($uname);
        $user = User::findOne(['uname'=>$uname]);
        if (is_null($user)) { 
            $data['message'] = sprintf('用户 %s 不存在！',$uname);
            return $this->asJson($data);
        }

        // 判断角色分配是否合规
        $role = strtoupper($role);
        if (!in_array($role,['M','E'])) {
            $data['message'] = '角色不对，只能为 M 或者 E';
            return $this->asJson($data);
        }
      
        $uid = $user->uid;
        $repo = Repo::findOne($repoid);
        // 当前用户即为相关 repo 的所有者，且邀请的不是自己
        if (Yii::$app->user->id == $repo->adminid && Yii::$app->user->id != $uid) {
            // 已经是项目的测试人员了
            if (JoinRepo::findOne(['uid'=>$uid,'repoid'=>$repoid])) { 
                $data['message'] = sprintf("%s 已经加入了 %s ",$uname,$repo->reponame);
                return $this->asJson($data);
            }
            // 已经发出了邀请
            if (Request::findOne(['applicantID'=>Yii::$app->user->id,'approverID'=>$uid,'repoID'=>$repoid])) {
                $data['message'] =  sprintf("对 %s 已经发出了邀请", $uname);
                return $this->asJson($data);
            }
            $request = new Request([
                'applicantID' => Yii::$app->user->id,
                'approverID' => $uid,
                'repoID' => $repoid,
                'mtID' => $role == 'M' ? 1 : 2,
                'role' => $role,
                ]);
            $request->save();
            $data['success'] = True;
            $data['message'] = "发出了邀请，请等待处理"; 
            return $this->asJson($data);                                
        } else {
            $data['message'] = sprintf("不可以邀请他人加入 %s，或者邀请的是自己",$repo->reponame);
            return $this->asJson($data);
        }
    }

    /**
     * 用户是否接受邀请加入项目
     */
    public function actionHandleInvite()
    {
        $data = ['success'=>True];

        $yiiRequest = Yii::$app->request; 
        $rid = $yiiRequest->post('rid');
        $approved = $yiiRequest->post('approved');

        if(is_null($rid) || is_null($approved)) {
            $data['success'] = False;
            $data['message'] = "缺少必要的变量";
            return $this->asJson($data);
        }

        $request = Request::findOne($rid);
        
        if ($approved) {
            $request->isApproved = 'y';
            $data['message'] = 'Accept invitation';
        } else {
            $request->isApproved = 'n';
            $data['message'] = 'Reject invitation';
        }
        
        if ($request->save()) {
            return $this->asJson($data);
        } else {
            return $this->asJson(['success'=>False,'message'=>'internal invite error']);
        }
    }
}
