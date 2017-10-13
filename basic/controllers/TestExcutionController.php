<?php

namespace app\controllers;

use Yii;
use app\models\TestCase;
use app\models\TestCaseSearch;
use app\models\TestExcution;
use app\models\TestExcutionSearch;
use app\models\TestResult;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\Helpers\ArrayHelper;

/**
 * TestExcutionController implements the CRUD actions for TestExcution model.
 */
class TestExcutionController extends Controller
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
     * Lists all TestExcution models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TestExcutionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionInsertTestPlan()
    {
        $repoid =Yii::$app->getRequest()->getQueryParam('repoid');
        $tpid = Yii::$app->getRequest()->get('id');
        $trs = TestResult::find()->select('tcid')->where(['teid'=>$tpid])->asArray()->all();
        // 已经存在于测试计划下的测试案例id
        $tcids = ArrayHelper::getColumn($trs,'tcid');
        $searchModel = (is_null($repoid)||empty($repoid)) ?  (new TestCaseSearch(['id' => -1])): (new TestCaseSearch(['repoid'=>$repoid]));
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('InsertTestPlan', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tpid' => $tpid,
            'tcids' => $tcids
        ]);
    }
    /**
     * Displays a single TestExcution model.
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
     * Creates a new TestExcution model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TestExcution();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TestExcution model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TestExcution model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionInsertTC2TP()
    {
        $tpid = Yii::$app->request->post('tpid');
        $tcids = Yii::$app->request->post('tcids');
        foreach($tcids as $tcid) {
            $tc = TestCase::findOne($tcid);
            $tc->initTestResult($tpid);
        }
        return $this->asJson(['success'=>True]);
    }

    /**
     * Finds the TestExcution model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TestExcution the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TestExcution::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
