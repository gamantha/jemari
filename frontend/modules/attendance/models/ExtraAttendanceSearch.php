<?php

namespace app\modules\attendance\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\attendance\models\ExtraAttendance;

/**
 * ExtraAttendanceSearch represents the model behind the search form about `app\modules\attendance\models\ExtraAttendance`.
 */
class ExtraAttendanceSearch extends ExtraAttendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kehadiran', 'sakit', 'ijin', 'cuti', 'alpa'], 'integer'],
            [['nik', 'datetime', 'status'], 'safe'],
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
        $query = ExtraAttendance::find();

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
            'datetime' => $this->datetime,
            'kehadiran' => $this->kehadiran,
            'sakit' => $this->sakit,
            'ijin' => $this->ijin,
            'cuti' => $this->cuti,
            'alpa' => $this->alpa,
        ]);

        $query->andFilterWhere(['like', 'nik', $this->nik])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
