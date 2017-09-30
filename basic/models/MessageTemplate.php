<?php
namespace app\models;
use yii\base\Object;

class MessageTemplate extends Object
{
	// request templates
	// {a} 表示请求发起者
	// {r} 表示 Repo 
	const RQTP = [
		0 => '{a} want to join project {r}',
		1 => '{a} invite you to join project {r} as a test manager',
		2 => '{a} invite you to join project {r} as a tester'
	];
	// message templates
	// {p} 表示 Repo 的参与者
	// {r} 表示 Repo
	const MGTP = [
		0 => '{p} become project {r} test manager',
		1 => '{p} become project {r} tester',
	];
}
