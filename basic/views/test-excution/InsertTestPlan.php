<?php

use app\models\JoinRepo;
use app\models\Repo;
use app\models\TestResult;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\CheckboxColumn;
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
	$tcidlist= TestResult::find()->where([
                'teid' =>  Yii::$app->getRequest()->getQueryParam('id'),
        ])->select('tcid')->all();
        $tcids=array();
        foreach($tcidlist as $tcid)
        {
        array_push($tcids,$tcid->tcid);
        }
 ?>
 <div>
 <div style="float:left;"><span>Select Repo:</span>
<?php $actual_link="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";$rid=isset($_GET["repoid"]) ? $_GET["repoid"] : '';$myurl=isset($_GET['repoid']) ? str_replace('&repoid='.$rid,'',$actual_link) : ($actual_link);$myurl="'".$myurl."&repoid='";?>
<?= Html::dropDownList('reponame', null, $reponamelist,['onchange' => 'if(this.value) window.location.href = '.$myurl.'+this.value','prompt' => '---Select a repo---',
          'options' =>
                    [                        
                      $rid => ['selected' => true]
                    ]
          ]); ?></div>
 <div style="float:right;"><?= Html::a('Insert Test Case into current test plan', ['InsertTC2TP'], ['class' => 'btn btn-success']) ?></div>
 </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => CheckboxColumn::className()],
            'tcid',
            'tctitle',
            'priority',
            'serverity',
            'repoid',
            // 'area',
            // 'category',
            // 'tag',
            // 'CreateDate',
        ['class' => 'yii\grid\DataColumn', // can be omitted, as it is the default
            'label' => 'In current test plan?',
            'value' => function ($data) use ($tcids){
                return in_array($data->tcid,$tcids)?"yes":"no"; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
        ],
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
