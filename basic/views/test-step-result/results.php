<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestStepsResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $testCaseTitle."的测试步骤";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-steps-result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sid',
            'trid',
            'content',
            [
                'attribute' => 'status',
                'content' => function ($model, $key, $index, $column) {
                    if (is_null($model->status) || empty($model->status)) {
                        return "未完成";
                    }
                    if ($model->status === 's') {
                        return "Success";
                    }
                    if ($model->status === 'f') {
                        return "Fail";
                    }
                }
            ],
            // 'whorun',
            // 'updatedate',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>
</div>
