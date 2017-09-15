<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestExcution */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-excution-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'milestone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CreateDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
