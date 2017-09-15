<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestExcution */

$this->title = $model->teid;
$this->params['breadcrumbs'][] = ['label' => 'Test Excutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-excution-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->teid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->teid], [
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
            'teid',
            'tename',
            'milestone',
            'CreateDate',
        ],
    ]) ?>

</div>
