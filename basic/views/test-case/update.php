<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestCase */

$this->title = 'Update Test Case: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Test Cases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-case-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formcreate', [
        'model' => $model,
    ]) ?>

</div>
