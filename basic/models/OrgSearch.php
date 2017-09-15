<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Org;

/**
 * OrgSearch represents the model behind the search form about `app\models\Org`.
 */
class OrgSearch extends Org
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orgid'], 'integer'],
            [['orgname', 'RegisterDate'], 'safe'],
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
        $query = Org::find();

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
            'orgid' => $this->orgid,
            'adminid' => Yii::$app->user->id,
            'RegisterDate' => $this->RegisterDate,
        ]);

        $query->andFilterWhere(['like', 'orgname', $this->orgname]);

        return $dataProvider;
    }
}
