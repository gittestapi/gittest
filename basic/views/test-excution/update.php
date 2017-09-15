<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TestExcution */

$this->title = 'Update Test Excution: ' . $model->teid;
$this->params['breadcrumbs'][] = ['label' => 'Test Excutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->teid, 'url' => ['view', 'id' => $model->teid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="test-excution-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
