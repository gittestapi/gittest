<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Cases in my joined projects (My role is test manager or tester)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-case-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Case', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'priority',
            'serverity',
            [
                'attribute' => 'repo.name',
                'label' => 'Repo',
                'content' => function($model, $key, $index, $column) {
                    return Html::a($model->repo->name,['test-case/gettestcasesbyrepoid','id'=>$model->repo->id]);
                }
            ],
            // 'area',
            // 'category',
            // 'tag',
            // 'CreateDate',

            [
              'class' => 'yii\grid\ActionColumn',
              'visibleButtons' => [
                  'update' => function ($model, $key, $index) {
                      return $model->repo->isTestManagerForUser(\Yii::$app->user->id);
                  },
                  'delete' => function ($model, $key, $index) {
                      return $model->repo->isTestManagerForUser(\Yii::$app->user->id);
                  },                       
              ]
            ],
			['class' => 'yii\grid\ActionColumn',
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                    return $model->repo->isTestManagerForUser(\Yii::$app->user->id)?Html::a('Detail', 'index.php?r=step%2Findex&tcid='.$key):null;
                },
				],//buttons
			],//class
        ],
    ]); ?>
</div>
