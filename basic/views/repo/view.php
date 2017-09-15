<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Repo */

$this->title = $model->repoid;
$this->params['breadcrumbs'][] = ['label' => 'Repos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->repoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'repoid',
            'reponame',
            'ishide',
            'RegisterDate',
        ],
    ]) ?>

</div>
