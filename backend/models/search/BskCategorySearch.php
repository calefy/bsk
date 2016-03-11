<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BskCategory;

/**
 * BskCategorySearch represents the model behind the search form about `common\models\BskCategory`.
 */
class BskCategorySearch extends BskCategory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade', 'science', 'semester', 'syllabus_id', 'type', 'lft', 'rgt', 'status', 'updated_by', 'created_by', 'updated_at', 'created_at'], 'integer'],
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
        $query = BskCategory::find();

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
            'semester' => $this->semester,
            'syllabus_id' => $this->syllabus_id,
            'type' => $this->type,
            'lft' => $this->lft,
            'rgt' => $this->rgt,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
