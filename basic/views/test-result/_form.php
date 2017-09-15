<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tcid')->textInput() ?>

    <?= $form->field($model, 'tctitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'whorun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'teid')->textInput() ?>

    <?= $form->field($model, 'gitissuelink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updatedate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
