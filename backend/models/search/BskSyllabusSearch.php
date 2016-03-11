<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BskSyllabus;

/**
 * BskSyllabusSearch represents the model behind the search form about `common\models\BskSyllabus`.
 */
class BskSyllabusSearch extends BskSyllabus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade', 'science', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer'],
            [['name'], 'safe'],
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
        $query = BskSyllabus::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grade' => $this->grade,
            'science' => $this->science,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
