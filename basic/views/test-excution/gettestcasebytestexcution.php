<?php
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
		'CreateDate'
	]
	]);
