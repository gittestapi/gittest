<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'My Projects';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('js/requests.js',['depends'=>[\yii\web\JqueryAsset::className(),]]);
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
            [
                'attribute' => 'reponame',
                'content' => function($model,$key,$index,$column) {
                    return Html::a($model->reponame,['repo/view','id'=>$model->repoid]);
                }
            ],
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
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],//class
		]//columns
    ]); ?>
<?php if($requestDataProvider->count > 0) :?>
    <h2>待处理请求</h2>
    <?= GridView::widget([
        'dataProvider' => $requestDataProvider,
        'columns' => [
            [   
                'attribute' => 'mtID',
                'class' => 'yii\grid\DataColumn',
                'label' => '请求',
                'enableSorting' => False,
                'content' => function($model,$key,$index,$column) {
                    return $model->requestMessage();
                }
            ],
            'created_at', 
            ['class' => 'yii\grid\ActionColumn', 
            'template' => '{approve}{refuse}',
            'buttons' => [
                'approve' => function ($url,$model,$key) {
                    $action = 'handle-join-in';
                    $roleOptions = 'M,E';
                    if($model->mtID > 0) {
                        $action = 'handle-join-in2';
                        $roleOptions = '';
                    }
                    return Html::a('approve', ['request/'.$action,'rid'=>$key,'approved'=>1],['class'=>'btn btn-success approve','data-roleoptions'=>$roleOptions]);
                },
                'refuse' => function ($url,$model,$key) {
                    $action = 'handle-join-in';
                    if($model->mtID > 0) {
                        $action = 'handle-join-in2';
                    }
                    return Html::a('refuse',['request/'.$action,'rid'=>$key,'approved'=>0],['class'=>'btn btn-danger approve']);
                }
                ],//buttons
            ],//class   
        ]
    ]) ?>

<?php endif; ?>
    <h2>消息</h2>
</div>
