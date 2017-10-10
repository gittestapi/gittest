<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'GitTest.com',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
			echo Nav::widget([
					'options' => ['class' => 'navbar-nav navbar-right'],
					'items' => [
						['label' => 'Home', 'url' => ['/site/index']],
						['label' => 'About', 'url' => ['/site/about']],
						['label' => 'Contact', 'url' => ['/site/contact']],
						['label' => 'Login', 'url' => ['/site/login']],
						['label' => 'Register', 'url' => ['/user/create']]
					],
			]);
	}
	else
	{
			echo Nav::widget([
					'options' => ['class' => 'navbar-nav navbar-right'],
					'items' => [
						['label' => 'Home', 'url' => ['/site/index']],
						['label' => 'About', 'url' => ['/site/about']],
						['label' => 'Contact', 'url' => ['/site/contact']],
						[
						'label' => 'More ('.Yii::$app->user->identity->name.')',
						'items' => [
							['label' => 'New Project/Repo »', 'url' => ['/repo/create']],
							['label' => 'My Project/Repo »', 'url' => ['/repo/index']],
							['label' => 'All Project/Repo »', 'url' => ['/repo/indexall']],
							['label' => 'New Test Cases »', 'url' => ['/test-case/create']],
							['label' => 'My Test Cases »', 'url' => ['/test-case/index']],
							['label' => 'New Test Plan »', 'url' => ['/test-excution/create']],
							['label' => 'My Test Plan »', 'url' => ['/test-excution/index']],
							'<li>'
							. Html::beginForm(['/site/logout'], 'post')
							. Html::submitButton(
							'>>> Sign out >>>',
							['class' => 'btn btn-info btn-lg']
							)
							. Html::endForm()
							. '</li>'
						        ],
						],
					],
			]);
	}
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><a href="https://github.com/gittestapi/gittest" target="_blank">GitTest Source Code</a> &copy; GitTest.com <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
