<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestExcutionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Test Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-excution-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Plan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'milestone',
            'CreateDate',

            ['class' => 'yii\grid\ActionColumn',
			'template' => '{link}',
			'buttons' => [
                'link' => function ($url,$model,$key) {
                                return Html::button('Insert Test Cases', [ 'class' => 'btn btn-primary', 'onclick' => "window.open('index.php?r=test-excution%2Finsert-test-plan&id=$key','_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=60,left=350,width=800, height=600');" ]);
                },
				],//buttons
	    ],//class
	    ['class' => 'yii\grid\ActionColumn',
			'template' => '{link}',
			'buttons' => [
                'link' => function ($url,$model,$key) {
                                return Html::button("Get this test plan's Test Cases", [ 'class' => 'btn btn-primary', 'onclick' => "window.open('index.php?r=test-excution%2Fgettestcasesbytestexcution&teid=$key','_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=60,left=350,width=800, height=600');" ]);
                },
				],//buttons
	    ],//class
	    ['class' => 'yii\grid\ActionColumn',
			'template' => '{link}',
			'buttons' => [
                'link' => function ($url,$model,$key) {
                                return Html::button("Get this test plan's Test Results", [ 'class' => 'btn btn-primary', 'onclick' => "window.open('index.php?r=test-excution%2Fget-test-results&id=$key','_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=60,left=350,width=800, height=600');" ]);
                },
				],//buttons
	    ],//class
            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function($url,$model,$key) {
                        if (is_null($model->designCompleted) || empty($model->designCompleted)) {
                            $handlerUrl = Url::to(['test-excution/confirm-complete','teid'=>$key]);
                            return Html::button("确认此测试计划设计完成",[ 'class' => 'btn btn-primary','onclick' => "var r = confirm('确定计划设计完成'); if (r==true) {window.location.href='".$handlerUrl."'}"]);
                        }
                    }
                ],
            ]
        ],
    ]); ?>
</div>
