<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BskExam;

/**
 * BskExamSearch represents the model behind the search form about `common\models\BskExam`.
 */
class BskExamSearch extends BskExam
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'category_id', 'status', 'updated_by', 'updated_at', 'created_by', 'created_at'], 'integer'],
            [['short_time', 'short_addr', 'title', 'description', 'stem'], 'safe'],
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
        $query = BskExam::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'category_id' => $this->category_id,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'short_time', $this->short_time])
            ->andFilterWhere(['like', 'short_addr', $this->short_addr])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'stem', $this->stem]);

        return $dataProvider;
    }
}
