<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestResultSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Test Results';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-result-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test Result', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'trid',
            'tcid',
            'tctitle',
            'status',
            'whorun',
            // 'teid',
            // 'gitissuelink',
            // 'updatedate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
