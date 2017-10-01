<?php

use app\models\JoinRepo;
use app\models\Repo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Please select Test Cases into test plan!';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-case-index">

    <h1>Please select Test Cases into test plan!</h1>
 <?php $joinrepos = JoinRepo::findAll([
		'uid' => Yii::$app->user->id,
	]);
	$repoidlist = ArrayHelper::map($joinrepos, 'repoid', 'repoid');
	$repos = Repo::findAll(['in', 'repoid',$repoidlist]);
	$reponamelist = ArrayHelper::map($repos, 'reponame', 'reponame');
 ?>
 <div>
 <div style="float:left;"><span>Select Repo:</span><? Html::activeDropDownList('reponame', reponame, $reponamelist); ?></div>
 <div style="float:right;"><?= Html::a('Insert Test Case into current test plan', ['InsertTC2TP'], ['class' => 'btn btn-success']) ?></div>
 </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tcid',
            'tctitle',
            'priority',
            'serverity',
            'repoid',
            // 'area',
            // 'category',
            // 'tag',
            // 'CreateDate',

			['class' => 'yii\grid\ActionColumn', 
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('Detail', 'index.php?r=steps%2Findex&id='.$key);
                },
				],//buttons
			],//class
        ],
    ]); ?>
</div>
