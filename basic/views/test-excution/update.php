<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestExcution */

$this->title = 'Update Test Excution: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Test Excutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-excution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
