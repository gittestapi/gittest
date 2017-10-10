<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Steps */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => 'index.php?r=step%2Findex&tcid='.$model->tcid];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="steps-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'content',
            'tcid',
        ],
    ]) ?>

</div>
