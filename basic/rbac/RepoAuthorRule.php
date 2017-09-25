<?php
namespace app\rbac;

use yii\rbac\Rule;

class RepoAuthorRule extends Rule
{
	public $name = "isRepoAuthor";

	public function execute($user,$item,$params)
	{
		return isset($params['entity']) ? $params['entity']->adminid == $user: false;
	}
}