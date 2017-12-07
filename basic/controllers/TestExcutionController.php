<?php

namespace app\controllers;

use Yii;
use app\models\TestCase;
use app\models\TestCaseSearch;
use app\models\TestExcution;
use app\models\TestExcutionSearch;
use app\models\TestCaseResult;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
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

    /**
    * 我（作为Tester）的测试任务
    */
    public function actionMyMissions()
    {
        $repos = Yii::$app->user->identity->getRepos('E')->all();
        $tcids = []; // 我 （作为Tester）能够参与的 TestCase ids
        foreach ($repos as $repo) {
            foreach($repo->testCases as $tc) {
                array_push($tcids,$tc->id);
            }
        }
        // 我（作为Tester）应该做的 TestCaseResults
        $tcrs = TestCaseResult::find()->select(['teid','tcid'])->where(['status'=>null])->andwhere(['in','tcid',$tcids])->asArray()->all();
        $missions = []; // key 为 TestExcution ID，val 为此 TestExcution 对应的 Repo IDs （我为 Tester）
        foreach($tcrs as $tcr) {
            $repoid = TestCase::findOne($tcr['tcid'])->repo->id;
            if (!array_key_exists($tcr['teid'],$missions)) {
                $missions[$tcr['teid']] = [$repoid];
            } else {
                if (!in_array($repoid,$missions[$tcr['teid']])) {
                    $missions[$tcr['teid']][] = $repoid;
                }
            }
        }
        $missionsData = []; // 每一个任务包括 任务id，任务名称，任务创建者ID，任务涉及到的 Repo IDs（仅包括我是这些 Repo 的Tester）
        foreach($missions as $k => $v) {
            $item = [];
            $tp = TestExcution::findOne($k);
            $item['id'] = $k;
            $item['name'] = $tp->name;
            $item['createrID'] = $tp->uid;
            $item['repoIDs'] = $v;
            $missionsData[] = $item;
        }
        $provider = new ArrayDataProvider([
            'allModels' => $missionsData,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['id','name'],
            ]
        ]);
        return $this->render('my-missions',['provider'=>$provider]);
    }

    public function actionInsertTestPlan()
    {
        $repoid =Yii::$app->getRequest()->getQueryParam('repoid');
        $tpid = Yii::$app->getRequest()->get('id');
        // 已经存在于测试计划下的测试案例id
        $tcids = TestExcution::findOne($tpid)->TCIDs;
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
            $model->uid = Yii::$app->user->id;
            $model->designCompleted = False;
            $model->save(false);
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
        $tp = TestExcution::findOne($tpid);
        if ($tp->designCompleted) {
            return $this->asJson(['success'=>False,'message'=>"当前测试计划已经设计完成，不能更改其下的 TestCases 了"]);
        }
        $tp->insertTCs($tcids);
        return $this->asJson(['success'=>True]);
    }

    //
    public function actionGettestcasesbytestexcution($teid=-1)
    {
        $searchModel = new TestCaseSearch();
        $dataProvider = $searchModel->searchTestCaseByTestExcution(Yii::$app->request->queryParams);
        return $this->render('gettestcasebytestexcution',[
            'dataProvider' => $dataProvider,
            'testExcution' => $this->findModel($teid),
        ]);
    }

    public function actionDeleteTestCase($teid,$tcid)
    {
        $request = Yii::$app->request;
        if ($request->isAjax && $request->isPost) {
            $result = new \stdClass;
            $result->success = False;

            $model = $this->findModel($teid);
            if ($model->designCompleted) { // 测试计划已经完成，不许再删除其下的案例
                $result->message='测试计划已经完成，不许再删除其下的案例';
            } else {
                $tcids = $model->TCIDs;
                $key = array_search($tcid,$tcids);
                if ($key !== false) {
                    \yii\helpers\ArrayHelper::removeValue($tcids,$tcid);
                    $model->tcids = json_encode(array_values($tcids));
                    if($model->save()) {
                        $result->success = True;
                    } else {
                        $result->message ='数据库操作错误';
                    }
                } else {
                    $result->message = '测试案例不在当前的测试计划中';
                }
            }
            return $this->asJson($result);
        } else {
            return "非 Post ,非 ajax, 不处理！";
        }
    }

    public function actionConfirmComplete($teid)
    {
        $request = Yii::$app->request;
        if ($request->isAjax && $request->isPost) {
            $result = new \stdClass;
            $result->success = False;

            $model = $this->findModel($teid);
            if (empty($model->TCIDs) || $model->designCompleted) {
                $result->message='此测试计划不包含 TestCase，无法标记为已完成，或者已经标记过了';
            } else {
                $model->designCompleted = True;
                if ($model->save()) {
                    // 创建此测试计划下相关的 testresult 和 teststepresult 表数据
                    foreach($model->TCIDs as $tcid) {
                        $tc = TestCase::findOne($tcid);
                        $tc->initTestResult($teid);
                    }
                    $result->success = True;
                } else {
                    $result->message = "数据库操作错误";
                }
            }
            return $this->asJson($result);
        } else {
            return "非 Post ,非 ajax, 不处理！";
        }
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
