<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Org */

$this->title = $model->orgid;
$this->params['breadcrumbs'][] = ['label' => 'Orgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->orgid], [
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
            'orgid',
            'orgname',
            'adminid',
            'RegisterDate',
        ],
    ]) ?>

</div>
