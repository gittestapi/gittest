<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Steps */

$this->title = 'Update Steps: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => ['index', 'tcid' => $model->tcid]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="step-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
