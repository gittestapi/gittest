<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JoinOrg */

$this->title = 'Create Join Org';
$this->params['breadcrumbs'][] = ['label' => 'Join Orgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="join-org-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
