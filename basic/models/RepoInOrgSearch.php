<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RepoInOrg;

/**
 * RepoInOrgSearch represents the model behind the search form about `app\models\RepoInOrg`.
 */
class RepoInOrgSearch extends RepoInOrg
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'repoid', 'orgid'], 'integer'],
            [['CreateDate'], 'safe'],
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
        $query = RepoInOrg::find();

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
            'repoid' => $this->repoid,
            'orgid' => $this->orgid,
            'CreateDate' => $this->CreateDate,
        ]);

        return $dataProvider;
    }
}
