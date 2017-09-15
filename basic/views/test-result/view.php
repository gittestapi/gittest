<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TestResult */

$this->title = $model->trid;
$this->params['breadcrumbs'][] = ['label' => 'Test Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-result-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->trid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->trid], [
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
            'trid',
            'tcid',
            'tctitle',
            'status',
            'whorun',
            'teid',
            'gitissuelink',
            'updatedate',
        ],
    ]) ?>

</div>
