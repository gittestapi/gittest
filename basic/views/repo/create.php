<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Repo */

$this->title = 'Create Repo';
$this->params['breadcrumbs'][] = ['label' => 'Repos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
