<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestExcutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Excutions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-excution-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Excution', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'teid',
            'tename',
            'milestone',
            'CreateDate',

            ['class' => 'yii\grid\ActionColumn', 
			'template' => '{link}',
			'buttons' => [
                'link' => function ($url,$model,$key) {
                                return Html::a('Insert Test Cases', 'index.php?r=test-excution%2Finsert-test-plan&id='.$key);
                },
				],//buttons
			],//class
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
