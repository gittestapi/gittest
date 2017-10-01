<?php

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
