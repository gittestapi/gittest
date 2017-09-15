<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestResult */

$this->title = 'Create Test Result';
$this->params['breadcrumbs'][] = ['label' => 'Test Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
