<?php

use app\models\JoinRepo;
use app\models\Repo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Please select Test Cases into test plan!';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-case-index">

    <h1>Please select Test Cases into test plan!</h1>
 <?php $repoidlist = JoinRepo::find()->where([
                'uid' => Yii::$app->user->id,
        ])->select('repoid')->all();
        $repoids=array();
        foreach($repoidlist as $repoid)
        {
        array_push($repoids,$repoid->repoid);
        }
        $repos = Repo::find()->where(['in', 'repoid',$repoids])->all();
        $reponamelist = ArrayHelper::map($repos, 'repoid', 'reponame');
 ?>
 <div>
 <div style="float:left;"><span>Select Repo:</span><?= Html::dropDownList('reponame', null, $reponamelist); ?></div>
 <div style="float:right;"><?= Html::a('Insert Test Case into current test plan', ['InsertTC2TP'], ['class' => 'btn btn-success']) ?></div>
 </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'tcid',
            'tctitle',
            'priority',
            'serverity',
            'repoid',
            // 'area',
            // 'category',
            // 'tag',
            // 'CreateDate',

			['class' => 'yii\grid\ActionColumn', 
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('Detail', 'index.php?r=steps%2Findex&id='.$key);
                },
				],//buttons
			],//class
        ],
    ]); ?>
</div>
