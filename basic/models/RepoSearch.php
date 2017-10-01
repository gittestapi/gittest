<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Repo;

/**
 * RepoSearch represents the model behind the search form about `app\models\Repo`.
 */
class RepoSearch extends Repo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repoid', 'adminid'], 'integer'],
            [['reponame', 'RegisterDate', 'ishide'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Repo::find()->orderBy(['RegisterDate'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'repoid' => $this->repoid,
            'adminid' => $this->adminid,
            'RegisterDate' => $this->RegisterDate,
        ]);

        $query->andFilterWhere(['like', 'reponame', $this->reponame])
            ->andFilterWhere(['like','ishide',$this->ishide]);

        return $dataProvider;
    }
    
    public function searchMyJoinedProject($params)
    {
        $cond = ['in', 'repoid', (new Query())->select('repoid')->from('JoinRepo')->where(['uid' => Yii::$app->user->id])];
        $query = Repo::find()->where($cond)->orderBy(['RegisterDate'=>SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'repoid' => $this->repoid,
            'adminid' => $this->adminid,
            'RegisterDate' => $this->RegisterDate,
        ]);

        $query->andFilterWhere(['like', 'reponame', $this->reponame])
            ->andFilterWhere(['like','ishide',$this->ishide]);

        return $dataProvider;
    }
}
