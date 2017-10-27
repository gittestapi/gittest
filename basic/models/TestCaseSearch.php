<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use app\models\TestCase;

/**
 * TestCaseSearch represents the model behind the search form about `app\models\TestCase`.
 */
class TestCaseSearch extends TestCase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'priority', 'serverity'], 'integer'],
            [['title', 'area', 'category', 'tag', 'CreateDate','repo.name'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(),['repo.name']);
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
        $query = TestCase::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [ 'pageSize' => 10 ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'priority' => $this->priority,
            'serverity' => $this->serverity,
            'repoid' => $this->repoid,
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }

    /**
     * 用户参加的Repo下的 TestCases
     */
    public function searchRelevantTestCase($params)
    {
        // 当前用户参与的项目，且用户在项目中的 role 为 'M'
        $cond = ['in', 'repoid', (new Query())->select('repoid')->from('joinrepo')->where(['uid' => Yii::$app->user->id,'role' => 'M'])];
        $query = TestCase::find()->where($cond);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 10 ],
        ]);

        $query->joinWith('repo as repo');

        $dataProvider->sort->attributes['repo.name'] = [
            'asc' => ['repo.name'  => SORT_ASC],
            'desc' => ['repo.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'priority' => $this->priority,
            'serverity' => $this->serverity,
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like','repo.name',$this->getAttribute('repo.name')]);

        return $dataProvider;
    }

    public function searchTestCaseByTestExcution($params)
    {
        $teid = Yii::$app->request->get('teid',-1);
        $cond = ['in', 'testcase.id', (new Query())->select('tcid')->from('testresult')->where(['teid' => $teid])];
        $query = TestCase::find()->where($cond);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [ 'pageSize' => 10 ],
        ]);

        $query->joinWith('repo as repo');

        $dataProvider->sort->attributes['repo.name'] = [
            'asc' => ['repo.name'  => SORT_ASC],
            'desc' => ['repo.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'priority' => $this->priority,
            'serverity' => $this->serverity,
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'tag', $this->tag])
            ->andFilterWhere(['like','repo.name',$this->getAttribute('repo.name')]);

        return $dataProvider;        
    }
}
