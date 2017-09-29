<?php
namespace app\controllers;

use Yii;
use app\models\Repo;
use app\models\Request;
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
     * 项目应该是共有的，目前缺乏判断
     */
	public function actionApplyJoinIn($repoID)
	{
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        $repo = Repo::findOne($repoID);

        // 如果已经申请
        if (\app\models\Request::findOne(['applicantID'=>Yii::$app->user->id,'repoID'=>$repoID])) {
            return [
                'success' => False,
                'message' => 'Already submited request!'
            ];
        } else {
            $model = new \app\models\Request([
                'applicantID'=>Yii::$app->user->id,
                'approverID'=>$repo->adminid,
                'repoID'=>$repoID,
                'mtID'=>0,
                ]);
            if ($model->save()) {
                return [
                    'success' => True,
                ];
            }                          
        }
        return [
            'success' => False,
            'message' => 'other errors!'
        ];
	}

    /**
     * Repo 所有者同意他人加入此 Repo ，或者拒绝
     * @param integer $rid Request 实体的主键
     * @param boolean $approved 是否同意
     * @param string $role 同意加入的话，角色设置，可取值 'M' 或 'E' 
     */
    public function actionHandleJoinIn($rid,$approved,$role='E')
    {
        $request = Request::findOne($rid);
        $data = ['success' => True];

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
     * 用户是否接受邀请加入项目
     */
    public function actionHandleJoinIn2($rid,$approved)
    {
        $request = Request::findOne($rid);
        $data = ['success'=>True];
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
