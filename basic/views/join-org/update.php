<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JoinOrg */

$this->title = 'Update Join Org: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Join Orgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="join-org-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
