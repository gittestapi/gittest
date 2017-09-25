<?php
namespace app\rbac;

use yii\rbac\Rule;

class RepoViewRule extends Rule
{
	public $name = "isRepoPublicOrIsOwn";

	public function execute($user,$item,$params)
	{
		return isset($params['entity']) ? ('n' == strtolower($params['entity']->ishide) || $user == $params['entity']->adminid) : false;
	}
}