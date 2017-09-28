<?php
namespace app\models;
use yii\base\Object;

class MessageTemplate extends Object
{
	// request templates
	// {a} 表示请求发起者
	// {r} 表示 Repo 
	const RQTP = [
		0 => '{a} 申请加入项目 {r}',
		1 => '{a} 邀请你加入项目 {r} 成为其测试管理员',
		2 => '{a} 邀请你加入项目 {r} 成为其测试执行员'
	];
	// message templates
	// {p} 表示 Repo 的参与者
	// {r} 表示 Repo
	const MGTP = [
		0 => '{p} 成为项目 {r} 的测试管理员',
		1 => '{p} 成为项目 {r} 的测试执行员',
	];
}