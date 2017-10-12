<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StepsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Steps';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'priority',
            'serverity',
            'repo.name',
            'area',
            'category',
            'tag',
            'CreateDate',
        ],
    ]) ?>
<div class="steps-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Create Step', '/index.php?r=step/create&tcid='.$model->id, ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content',
            'tcid',

            ['class' => 'yii\grid\ActionColumn', 
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('Detail', 'index.php?r=step%2Fviewonly&id='.$key);
                },
				],//buttons
			],//class
        ],
    ]); ?>
</div>
