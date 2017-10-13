<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\CheckboxColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TestCaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Please select Test Cases into test plan!';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('js/inserttc2tp.js',['depends'=>[\yii\grid\GridViewAsset::className(),]]);

// 获取当前用户所参与的项目（其为项目的测试管理人员 ）
$reponamelist = \Yii::$app->user->identity->getRepos('M');
?>
<div class="test-case-index">

    <h1>Please select Test Cases into test plan!</h1>
 <?php 
        
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
 <div style="float:right;"><?= Html::a('Insert Test Case into current test plan', ['insert-t-c2-t-p'], ['class' => 'btn btn-success','id'=>'inserttc2tp','data'=>['tpid'=>$tpid]]) ?></div>
 </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::className(),
                'checkboxOptions' => function($model, $key, $index, $column) use ($tcids) {
                    if(in_array($model->id.'',$tcids)) {
                        return ['disabled'=> true];
                    }
                }
            ],
            'id',
            'title',
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
                return in_array($data->id.'', $tcids)?"yes":"no"; // $data['name'] for array data, e.g. using SqlDataProvider.
            },
        ],
			['class' => 'yii\grid\ActionColumn', 
			'template' => '{view}',
			'buttons' => [
                'view' => function ($url,$model,$key) {
                                return Html::a('Detail', 'index.php?r=step%2Findex&tcid='.$key);
                },
				],//buttons
			],//class
        ],
    ]); ?>
</div>
