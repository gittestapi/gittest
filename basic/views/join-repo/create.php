<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JoinRepo */

$this->title = 'Create Join Repo';
$this->params['breadcrumbs'][] = ['label' => 'Join Repos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="join-repo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
