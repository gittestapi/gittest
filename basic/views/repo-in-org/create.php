<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RepoInOrg */

$this->title = 'Create Repo In Org';
$this->params['breadcrumbs'][] = ['label' => 'Repo In Orgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="repo-in-org-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
