<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Steps */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Steps', 'url' => 'index.php?r=step%2Fgetstepsbycaseid&id='.$model->tcid];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="steps-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content',
            'tcid',
        ],
    ]) ?>

</div>
