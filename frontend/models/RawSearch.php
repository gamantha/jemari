<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Raw;

/**
 * RawSearch represents the model behind the search form about `app\models\Raw`.
 */
class RawSearch extends Raw
{
    /**
     * @inheritdoc
     */

    public $from_date;
    public $to_date;
    public function rules()
    {
        return [
            [['hardware_id', 'pin', 'datetime', 'verified', 'status', 'workcode','from_date','to_date'], 'safe'],
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
        $query = Raw::find();

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
            'datetime' => $this->datetime,
        ]);

        $query->andFilterWhere(['like', 'hardware_id', $this->hardware_id])
            ->andFilterWhere(['like', 'pin', $this->pin])
            ->andFilterWhere(['like', 'verified', $this->verified])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'workcode', $this->workcode]);

        return $dataProvider;
    }
}
