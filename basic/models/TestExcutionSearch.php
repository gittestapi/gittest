<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TestExcution;

/**
 * TestExcutionSearch represents the model behind the search form about `app\models\TestExcution`.
 */
class TestExcutionSearch extends TestExcution
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['teid'], 'integer'],
            [['tename', 'milestone', 'CreateDate'], 'safe'],
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
        $query = TestExcution::find();

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
            'teid' => $this->teid,
            'CreateDate' => $this->CreateDate,
        ]);

        $query->andFilterWhere(['like', 'tename', $this->tename])
            ->andFilterWhere(['like', 'milestone', $this->milestone]);

        return $dataProvider;
    }
}
