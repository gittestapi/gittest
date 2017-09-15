<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestStepsResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-steps-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sid')->textInput() ?>

    <?= $form->field($model, 'tcid')->textInput() ?>

    <?= $form->field($model, 'trid')->textInput() ?>

    <?= $form->field($model, 'content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'whorun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updatedate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
