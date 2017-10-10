<?php

use app\models\Area;
use app\models\Category;
use app\models\JoinRepo;
use app\models\Tag;
use app\models\Repo;
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
		'role' => 'M'
	]);
	$repoidlist = ArrayHelper::getColumn($joinrepos, 'repoid');
	$repolist = [];
	foreach($repoidlist as $id) {
		$repolist[$id] = Repo::findOne($id)->name;
	}
	?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'priority')->dropDownList(array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4'), array('options' => array('0'=>array('selected'=>true)))) ?>

    <?= $form->field($model, 'serverity')->dropDownList(array('0'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4'), array('options' => array('0'=>array('selected'=>true)))) ?>

    <?= $form->field($model, 'repoid')->dropDownList($repolist) ?>

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

<?php if($model->isNewRecord): ?> 
    <h2>steps</h2>
    <div class="form-group">
	    <h3>step 1</h3>
	    <input class="form-control" name="steps[contents][0]" type="text">    	
	</div>
	<div>
	    <h3>step 2</h3>
	    <input class="form-control" name="steps[contents][1]" type="text">
	</div>
<?php endif; ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
