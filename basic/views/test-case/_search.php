<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestCaseSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-case-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tcid') ?>

    <?= $form->field($model, 'tctitle') ?>

    <?= $form->field($model, 'priority') ?>

    <?= $form->field($model, 'serverity') ?>

    <?= $form->field($model, 'repoid') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'tag') ?>

    <?php // echo $form->field($model, 'CreateDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
