<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use app\models\Repo;


$this->title = '我的测试任务';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-excution-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'attribute' => 'name',
            ],
            'createrID',
            [
                'class' => 'yii\grid\DataColumn',
                'attribute' => 'repoIDs',
                'content' => function ($model, $key, $index, $column) {
                    $repoLinks = '';
                    foreach($model['repoIDs'] as $repoid) {
                        $repoLinks .= (Html::a(Repo::findOne($repoid)->name,['repo/view','id'=>$repoid]).' ');
                    }
                    return $repoLinks;
                }
            ],
            [
                'attribute' => 'state',
                'content' => function ($model, $key, $index, $column) {
                    if ($model['state'] === 'c') {
                        return 'complated';
                    }
                    return 'uncomplated';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url,$model,$key) {
                        return Html::a('录入结果',['test-result/task','tpid'=>$model['id']]);
                    }
                ],
            ]
        ],
    ]); ?>
</div>
