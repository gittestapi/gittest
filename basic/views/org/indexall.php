<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Orgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orgid',
            'orgname',
            'RegisterDate',

            ['class' => 'yii\grid\ActionColumn', 
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('GetProjects', 'index.php?r=repo-in-org%2Fgetreposbyorgid&id='.$key);
                },
				],//buttons
			],//class
			
			['class' => 'yii\grid\ActionColumn', 
			'template' => '{link}',
			'buttons' => [
				'link' => function ($url,$model,$key) {
                                return Html::a('JoinOrg', 'index.php?r=join-org%2Fjoinorgbyorgid&id='.$key);
                },
				],//buttons
			],//class
		]//columns
    ]); ?>
</div>
