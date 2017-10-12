<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestCase;

/**
 * TestCaseSearch represents the model behind the search form about `app\models\TestCase`.
 */
class TestCaseSearch2 extends TestCase
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'priority', 'serverity'], 'integer'],
            [['title', 'area', 'category', 'tag', 'CreateDate'], 'safe'],
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
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
	
	public function search2($id, $params)
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
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'tag', $this->tag]);

        return $dataProvider;
    }
}
