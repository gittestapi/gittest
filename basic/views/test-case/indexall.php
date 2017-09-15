<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Test Cases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-case-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                                return Html::a('Detail', 'index.php?r=steps%2Fgetstepsbycaseid&id='.$key);
                },
				],//buttons
			],//class
        ],
    ]); ?>
</div>
