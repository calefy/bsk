<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\BskQuestion;

/**
 * Account form
 */
class QuestionForm extends Model
{
    public $id; // 试题的ID
    public $type; // 题型
    public $difficult; // 难度系数
    public $chapter_id; // 章节分类ID
    public $point_ids; // 考点分类ID

    public $title; // 题干
    public $info; // 选项或回答json

    public $analyze; // 解析

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'difficult', 'chapter_id', 'title'], 'required'],
            [['type', 'chapter_id'], 'integer'],
            ['type', 'in', 'range' => array_keys(BskQuestion::types()) ],
            ['difficult', 'double', 'min' => 0, 'max' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'type' => '题型',
            'difficult' => '难度系数',
            'chapter_id' => '试题章节',
            'point_ids' => '试题考点',
            'title' => '题干',
            'info' => '选项或答案',
            'analyze' => '解析',
        ];
    }
}

