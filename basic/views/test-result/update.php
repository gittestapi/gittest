<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestResult */

$this->title = 'Update Test Result: ' . $model->trid;
$this->params['breadcrumbs'][] = ['label' => 'Test Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->trid, 'url' => ['view', 'id' => $model->trid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
