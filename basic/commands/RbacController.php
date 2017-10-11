<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
	public function actionInit()
	{
		$auth = Yii::$app->authManager;

		// add the rules
		$rule1 = new \app\rbac\RepoAuthorRule;
		$auth->add($rule1);

		//add "changeRepo" permission
		$changeRepo = $auth->createPermission('changeRepo');
		$changeRepo->description = 'update or delete Repo entity';
		$changeRepo->ruleName = $rule1->name;
		$auth->add($changeRepo);

		// add "commonUser" role
		$commonUser = $auth->createRole("commonUser");
		$auth->add($commonUser);
		$auth->addChild($commonUser,$changeRepo);

		// 将默认的账号user001添加到角色commonUser中
		//$auth->assign($commonUser,1);
	}
}