<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'repoid',
            'reponame',
            'ishide',
            'RegisterDate',

            ['class' => 'yii\grid\ActionColumn', 
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('Get TestCases', 'index.php?r=test-case%2Fgettestcasesbyrepoid&id='.$key);
                },
				],//buttons
			],//class
			
			['class' => 'yii\grid\ActionColumn', 
			'template' => '{link}',
			'buttons' => [
                'link' => function ($url,$model,$key) {
                                return Html::a('Get Members', 'index.php?r=join-repo%2Fgetusersbyrepoid&id='.$key);
                },
				],//buttons
			],//class
		]//columns
    ]); ?>
</div>
