<?php

namespace app\controllers;

use Yii;
use app\models\Step;
use app\models\StepSearch;
use app\models\StepSearch2;
use app\models\TestCase;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StepsController implements the CRUD actions for Steps model.
 */
class StepController extends Controller
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
     * Lists all Steps models.
     * @return mixed
     */
    public function actionIndex($tcid)
    {
        //return $this->runAction('getstepsbycaseid',['id'=>$tcid]);
        $searchModel = new StepSearch2();
        $dataProvider = $searchModel->search2($tcid,Yii::$app->request->queryParams);
        return $this->render('index', [
			'model' => $this->findTCModel($tcid),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	public function actionGetstepsbycaseid($id)
    {
        $searchModel = new StepSearch2();
        $dataProvider = $searchModel->search2($id,Yii::$app->request->queryParams);

        return $this->render('getstepsbycaseid', [
			'model' => $this->findTCModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	protected function findTCModel($id)
    {
        if (($model2 = TestCase::findOne($id)) !== null) {
            return $model2;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays a single Steps model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
	
	public function actionViewonly($id)
    {
        return $this->render('viewonly', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Steps model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
        // $model = new Steps();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->sid]);
        // } else {
            // return $this->render('create', [
                // 'model' => $model,
            // ]);
        // }
    // }
	
	public function actionCreate($tcid)
    {
        $model = new Step();
		$model->tcid = $tcid;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['step/index', 'tcid' => $model->tcid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Steps model.
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
     * Deletes an existing Steps model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tcid = $model->tcid;
        $model->delete();
        return $this->redirect(['index','tcid'=>$tcid]);
    }

    /**
     * Finds the Steps model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Steps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Step::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
