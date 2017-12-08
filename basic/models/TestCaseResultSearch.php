<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Repo;

/**
 * TestResultSearch represents the model behind the search form about `app\models\TestResult`.
 */
class TestCaseResultSearch extends TestCaseResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tcid', 'teid'], 'integer'],
            [['status', 'whorun', 'gitissuelink', 'updatedate'], 'safe'],
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
        $query = TestCaseResult::find();

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
            'id' => $this->id,
            'tcid' => $this->tcid,
            'teid' => $this->teid,
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'whorun', $this->whorun])
            ->andFilterWhere(['like', 'gitissuelink', $this->gitissuelink]);

        return $dataProvider;
    }

    /*
    ** 需要更新的 TestCaseResult (只针对一个 TestPlan 和 一个 Repo)
    ** Repo 的 TestManager 可以查看
    */
    public function searchForTestManager($params,$teid,$repoid)
    {
        $query = TestCaseResult::find();

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
            'id' => $this->id,
            'tcid' => $this->tcid,
            'teid' => $teid, // 过滤特定测试计划下的 TestCaseResults
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'whorun', $this->whorun])
            ->andFilterWhere(['like', 'gitissuelink', $this->gitissuelink]);

        // 继续过滤，把 TestCaseResult 限制在一个项目中
        $repo = Repo::findOne($repoid);
        $tcids = $repo->getTestCases()->select(['id'])->asArray()->all();
        $tcids = yii\helpers\ArrayHelper::getColumn($tcids,'id');
        $query->andFilterWhere(['in','tcid',$tcids]);

        return $dataProvider;
    }
}
