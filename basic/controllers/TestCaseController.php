<?php

namespace app\controllers;

use Yii;
use app\models\Repo;
use app\models\TestCase;
use app\models\Step;
use app\models\TestCaseSearch;
use app\models\TestCaseSearch2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestCaseController implements the CRUD actions for TestCase model.
 */
class TestCaseController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * 列出当前用户参与的 repo 下的所有 TestCase （且当前用户对于 repo 的身份为测试管理员）
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestCaseSearch();
        $dataProvider = $searchModel->searchRelevantTestCase(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionGettestcasesbyrepoid($id)
    {
        $searchModel = new TestCaseSearch2();
        $dataProvider = $searchModel->search2($id,Yii::$app->request->queryParams);
        $repo = $this->findRepoModel($id);

        $viewTemplate = 'gettestcasesbyrepoid';
        if(!Yii::$app->user->isGuest && $repo->isTestManagerForUser(Yii::$app->user->id)) {
            $viewTemplate = 'gettestcasesbyrepoid2';
        }

        return $this->render($viewTemplate, [
			'model' => $repo,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	protected function findRepoModel($id)
    {
        if (($model2 = Repo::findOne($id)) !== null) {
            return $model2;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	public function actionIndexall()
    {
        $searchModel = new TestCaseSearch2();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TestCase model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TestCase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestCase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $contents = Yii::$app->request->post('steps');
            $contents = $contents['contents'];
            foreach($contents as $c) {
                $step = new Step();
                $step->content = trim($c);
                $step->tcid = $model->id;
                if($step->validate()){
                    $step->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreateForRepo($repoid)
    {
        $model = new TestCase(['repoid' => $repoid]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $contents = Yii::$app->request->post('steps');
            $contents = $contents['contents'];
            foreach($contents as $c) {
                $step = new Step();
                $step->content = trim($c);
                $step->tcid = $model->id;
                if($step->validate()){
                    $step->save(false);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TestCase model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->whorun = Yii::$app->user->id;
            $model->save(false);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TestCase model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TestCase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestCase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestCase::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
