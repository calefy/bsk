<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BskCategoryOther;

/**
 * BskCategoryOtherSearch represents the model behind the search form about `common\models\BskCategoryOther`.
 */
class BskCategoryOtherSearch extends BskCategoryOther
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'grade_id', 'semester_id', 'science_id', 'syllabus_id', 'category_id', 'type', 'status', 'updated_at', 'created_at', 'updated_by', 'created_by'], 'integer'],
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
        $query = BskCategoryOther::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'grade_id' => $this->grade_id,
            'semester_id' => $this->semester_id,
            'science_id' => $this->science_id,
            'syllabus_id' => $this->syllabus_id,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'status' => $this->status,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'updated_by' => $this->updated_by,
            'created_by' => $this->created_by,
        ]);

        return $dataProvider;
    }
}
