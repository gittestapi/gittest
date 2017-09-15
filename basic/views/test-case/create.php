<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TestCase */

$this->title = 'Create Test Case';
$this->params['breadcrumbs'][] = ['label' => 'Test Cases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-case-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formcreate', [
        'model' => $model,
    ]) ?>

</div>
