<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'TestPlan "' . $testPlanTitle . '" Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'testCase.title',
            'testCase.repo.name',
            'content',
            [
                'attribute' => 'status',
                'content' => function ($model, $key, $index, $column) {
                    if ($model->status === 's') {
                        return 'Success';
                    } elseif($model->status === 'f') {
                        return 'Fail';
                    } else {
                        return 'Uncomplated';
                    }
                }
            ],
            'whorun',
            'gitissuelink',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{link}',
                'buttons' => [
                    'link' => function ($url,$model,$key) {
                        return Html::a('查看TestSteps结果',['test-step-result/results','tcrid'=>$model->id],['target'=>'_blank']);
                    }
                ],
            ],
        ],
    ]); ?>
</div>
