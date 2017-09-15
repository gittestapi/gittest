<?php

use app\models\Area;
use app\models\Category;
use app\models\JoinRepo;
use app\models\Tag;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TestCase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-case-form">

    <?php $form = ActiveForm::begin(); 
	$joinrepos = JoinRepo::findAll([
		'uid' => Yii::$app->user->id,
	]);
	$repoidlist = ArrayHelper::map($joinrepos, 'repoid', 'repoid');
	?>

    <?= $form->field($model, 'tctitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority')->dropDownList(array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4'), array('options' => array('0'=>array('selected'=>true)))) ?>

    <?= $form->field($model, 'serverity')->dropDownList(array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4'), array('options' => array('0'=>array('selected'=>true)))) ?>

    <?= $form->field($model, 'repoid')->dropDownList($repoidlist) ?>

	<?php 
	$areas = Area::find()->where(['in','repoid',$repoidlist])->all();
	$arealist = ArrayHelper::map($areas, 'area', 'area');
	?>
	
    <?= $form->field($model, 'area')->dropDownList($arealist) ?>

	<?php 
	$categories = Category::find()->where(['in','repoid',$repoidlist])->all();
	$caglist = ArrayHelper::map($categories, 'category', 'category');
	?>
	
    <?= $form->field($model, 'category')->dropDownList($caglist) ?>

	<?php 
	$tags = Tag::find()->where(['in','repoid',$repoidlist])->all();
	$taglist = ArrayHelper::map($tags, 'tag', 'tag');
	?>
	
    <?= $form->field($model, 'tag')->dropDownList($taglist) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
