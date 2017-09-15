<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Org */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="org-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orgname')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Create' , ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
