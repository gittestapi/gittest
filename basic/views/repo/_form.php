<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Repo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reponame')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ishide')->radioList(['y' => 'Yes','n' => 'Nope']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
