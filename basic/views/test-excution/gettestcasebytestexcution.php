<?php
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = $testExcution->name .'下的 test case';
$this->params['breadcrumbs'][] = $this->title;

echo GridView::widget([
	'dataProvider' => $dataProvider,
	'columns' => [
		'id',
		'title',
		'priority',
		'serverity',
		'repo.name',
		'area',
		'category',
		'tag',
		'CreateDate',
		[
			'class' => 'yii\grid\ActionColumn',
			'controller' => 'test-case',
			'template' => '{view} {update}'
		],
		[
			'class' => 'yii\grid\ActionColumn',
			'template' => '{link}',
			'buttons' => [
				'link' => function($url,$model,$key) {
					return Html::a('Remove This From The TestPlan',['test-excution/delete-test-case','teid'=>\Yii::$app->request->get('teid'),'tcid'=>$key]);
				},
			],
		],
	]
	]);
