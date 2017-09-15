<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RepoInOrgSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Repo In Orgs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repo-in-org-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Repo In Org', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'repoid',
            'orgid',
            'CreateDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
