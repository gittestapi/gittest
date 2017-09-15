<?php

namespace app\controllers;

use Yii;
use app\models\Org;
use app\models\OrgSearch;
use app\models\OrgSearch2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrgController implements the CRUD actions for Org model.
 */
class OrgController extends Controller
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
     * Lists all Org models.
     * @return mixed
     */
    public function actionIndex()
    {
		if(Yii::$app->user->isGuest)
		{
			return $this->goHome();
		}
	
        $searchModel = new OrgSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

	public function actionIndexall()
    {
        $searchModel = new OrgSearch2();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('indexall', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
    /**
     * Displays a single Org model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		if(Yii::$app->user->isGuest)
		{
			return $this->goHome();
		}
		
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Org model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if(Yii::$app->user->isGuest)
		{
			return $this->goHome();
		}
		
        $model = new Org();
		$model->adminid=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->orgid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Org model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
		if(Yii::$app->user->isGuest)
		{
			return $this->goHome();
		}
		
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Org model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Org the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Org::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
