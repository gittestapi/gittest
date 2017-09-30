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
<?php if($model->adminid == \Yii::$app->user->id): ?>
    <h3>邀请人员加入</h3>
    <p>邀请<input>加入，成为 testManager <button class="invite" data-role="M" data-repoid="<?= $model->repoid ?>" data-url="<?= Url::to(["request/invite"]) ?>">确定</button></p>
    <p>邀请<input>加入，成为 tester <button class="invite" data-role="E" data-repoid="<?= $model->repoid ?>" data-url="<?= Url::to(["request/invite"]) ?>">确定</button></p>
<?php endif; ?>
<?php if($testManagers): ?>
    <h3>Test Manager</h3>
    <ul>
    <?php foreach($testManagers as $m): ?>
        <li><?= Html::a($m->uname,['repo/index-for-user','uid'=>$m->uid]) ?></li>
    <?php endforeach; ?>
    </ul>    
<?php endif; ?>
<?php if($testers): ?>
    <h3>Tester</h3>
    <ul>
    <?php foreach($testers as $t): ?>
        <li><?= Html::a($t->uname,['repo/index-for-user','uid'=>$t->uid]) ?></li>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php if(!\Yii::$app->user->isGuest && !$model->isRelevantForUser(\Yii::$app->user->id)): ?>
    <div>
        <a href="<?= Url::to(['request/apply-join-in'],true) ?>" class="btn btn-danger apply" data-repoid="<?= $model->repoid ?>" data-guest="<?= \Yii::$app->user->isGuest ?>">申请加入项目</a>
    </div>
<?php endif; ?>



</div>
