<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'repoid') ?>

    <?= $form->field($model, 'reponame') ?>

    <?= $form->field($model, 'ishide') ?>

    <?= $form->field($model, 'RegisterDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
