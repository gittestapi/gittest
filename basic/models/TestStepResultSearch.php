<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestStepsResult;

/**
 * TestStepsResultSearch represents the model behind the search form about `app\models\TestStepsResult`.
 */
class TestStepResultSearch extends TestStepResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sid', 'trid'], 'integer'],
            [['content', 'status', 'whorun', 'updatedate'], 'safe'],
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
        $query = TestStepResult::find();

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
            'sid' => $this->sid,
            'trid' => $this->trid,
            'updatedate' => $this->updatedate,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'whorun', $this->whorun]);

        return $dataProvider;
    }
}
