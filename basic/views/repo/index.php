<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Projects';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Project', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
			'template' => '{link}',
			'buttons' => [
                'link' => function ($url,$model,$key) {
                                return Html::a('My Test Cases', 'index.php?r=test-case%2Findex&id='.$key);
                },
				],//buttons
			],//class
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}{delete}'],//class
		]//columns
    ]); ?>
</div>
