<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JoinOrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Join Orgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="join-org-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Join Org', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uid',
            'orgid',
            'IsApproved',
            'JoinDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
