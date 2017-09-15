<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepoInOrg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="repo-in-org-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'repoid')->textInput() ?>

    <?= $form->field($model, 'orgid')->textInput() ?>

    <?= $form->field($model, 'CreateDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
