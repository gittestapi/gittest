<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Org */

$this->title = 'Create Org';
$this->params['breadcrumbs'][] = ['label' => 'Orgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="org-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
