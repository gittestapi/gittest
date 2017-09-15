<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestExcution */

$this->title = 'Create Test Excution';
$this->params['breadcrumbs'][] = ['label' => 'Test Excutions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-excution-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
