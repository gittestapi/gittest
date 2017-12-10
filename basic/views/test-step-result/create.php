<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestStepsResult */

$this->title = 'Create Test Steps Result';
$this->params['breadcrumbs'][] = ['label' => 'Test Steps Results', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-steps-result-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
