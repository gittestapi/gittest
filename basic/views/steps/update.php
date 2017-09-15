<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Steps */

$this->title = 'Update Steps: ' . $model->sid;
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => ['index', 'id' => $model->tcid]];
$this->params['breadcrumbs'][] = ['label' => $model->sid, 'url' => ['view', 'id' => $model->sid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="steps-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
