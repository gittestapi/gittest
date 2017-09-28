<?php
namespace app\models;

use Yii;
use app\models\Request;
use yii\data\ActiveDataProvider;

class RequestSearch extends Request
{
    public function search()
    {
        $query = Request::find()
        	->where(['approverID'=>Yii::$app->user->id,'isApproved'=>null])
        	->orderBy(['created_at'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }	
}