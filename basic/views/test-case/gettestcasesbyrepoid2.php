<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Test Cases For ' . $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'ishide',
            'RegisterDate',
        ],
    ]) ?>
<div class="test-case-index">
    <?= 
    Html::a('Add New TestCase for This Repo',
    ['test-case/create-for-repo','repoid'=>$model->id],['class'=>'btn btn-success']) ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'priority',
            'serverity',
            // 'area',
            // 'category',
            // 'tag',
            // 'CreateDate',

            ['class' => 'yii\grid\ActionColumn', 
			'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('Detail', 'index.php?r=step%2Fgetstepsbycaseid&id='.$key);
                },
                ],//buttons            
			],//class
        ],
    ]); ?>
</div>
