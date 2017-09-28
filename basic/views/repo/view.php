<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Repo */

$this->title = $model->reponame;
$this->params['breadcrumbs'][] = ['label' => 'Repos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('js/requests.js',['depends'=>[\yii\web\JqueryAsset::className(),]]);
?>
<div class="repo-view">

    <h1><?= Html::encode($this->title) ?></h1>

<?php if($model->adminid == \Yii::$app->user->id): ?>
    <p>
        <?= Html::a('Delete', ['delete', 'id' => $model->repoid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'repoid',
            'ishide',
            'RegisterDate',
            [
                'label' => 'Owner',
                'value' => Html::a($model->user->uname,['repo/index-for-user','uid'=>$model->user->uid]),
                'format' => 'html',
            ],
        ],
    ]) ?>
<?php if($testManagers): ?>
    <h3>测试管理人员</h3>
    <ul>
    <?php foreach($testManagers as $m): ?>
        <li><?= Html::a($m->uname,['repo/index-for-user','uid'=>$m->uid]) ?></li>
    <?php endforeach; ?>
    </ul>    
<?php endif; ?>
<?php if($testExecuters): ?>
    <h3>测试执行人员</h3>
    <ul>
    <?php foreach($testExecuters as $e): ?>
        <li><?= Html::a($e->uname,['repo/index-for-user','uid'=>$e->uid]) ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if($model->adminid != \Yii::$app->user->id && !\Yii::$app->user->isGuest): ?>
    <div>
        <a id="apply" href="<?= Url::to(['request/apply-join-in','repoID'=>$model->repoid],true) ?>" class="btn btn-danger" data-repoid="<?= $model->repoid ?>" data-guest="<?= \Yii::$app->user->isGuest ?>">申请加入项目</a>
    </div>
<?php endif; ?>



</div>
