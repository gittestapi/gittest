<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Repo */

$this->title = 'Update Repo: ' . $model->repoid;
$this->params['breadcrumbs'][] = ['label' => 'Repos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->repoid, 'url' => ['view', 'id' => $model->repoid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="repo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
