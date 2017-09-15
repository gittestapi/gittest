<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JoinRepoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Join Repos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="join-repo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Join Repo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uid',
            'repoid',
            'IsApproved',
            'JoinDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
