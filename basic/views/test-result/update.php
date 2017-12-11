<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestResult */

$this->title = 'Update Test Result: ' . $model->testCase->title;
$this->params['breadcrumbs'][] = ['label' => $model->testPlan->name, 'url' => ['test-result/task','tpid'=>$model->testPlan->id]];
$this->params['breadcrumbs'][] = ['label' => $model->testCase->title, 'url' => ['test-result/update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
