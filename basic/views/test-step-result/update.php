<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestStepsResult */

$this->title = 'Update Test Steps Result: ' . $model->testStep->content;
$this->params['breadcrumbs'][] = ['label' => $model->testCaseResult->testPlan->name, 'url' => ['test-result/task','tpid'=>$model->testCaseResult->testPlan->id]];
$this->params['breadcrumbs'][] = ['label' => $model->testCaseResult->testCase->title, 'url' => ['test-result/update', 'id' => $model->testCaseResult->id]];
$this->params['breadcrumbs'][] = 'Update';


?>
<div class="test-steps-result-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
