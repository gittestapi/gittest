<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\JoinRepo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="join-repo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'repoid')->textInput() ?>

    <?= $form->field($model, 'IsApproved')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'JoinDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
