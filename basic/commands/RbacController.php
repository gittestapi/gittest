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
		$rule2 = new \app\rbac\RepoViewRule;
		$auth->add($rule2);

		//add "changeRepo" permission
		$changeRepo = $auth->createPermission('changeRepo');
		$changeRepo->description = 'update or delete Repo entity';
		$changeRepo->ruleName = $rule1->name;
		$auth->add($changeRepo);

		// add "viewRepo" permission
		$viewRepo = $auth->createPermission('viewRepo');
		$viewRepo->description = 'view Repo entity';
		$viewRepo->ruleName = $rule2->name;
		$auth->add($viewRepo);

		// add "commonUser" role
		$commonUser = $auth->createRole("commonUser");
		$auth->add($commonUser);
		$auth->addChild($commonUser,$changeRepo);
		$auth->addChild($commonUser,$viewRepo);

		// 将默认的账号user001添加到角色commonUser中
		$auth->assign($commonUser,1);
	}
}