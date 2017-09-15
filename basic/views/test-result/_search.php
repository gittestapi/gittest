<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestResultSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-result-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'trid') ?>

    <?= $form->field($model, 'tcid') ?>

    <?= $form->field($model, 'tctitle') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'whorun') ?>

    <?php // echo $form->field($model, 'teid') ?>

    <?php // echo $form->field($model, 'gitissuelink') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
