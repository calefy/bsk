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
    public $point_ids; // 考点分类IDs
    public $origin_exam_id;

    public $title; // 题干
    public $info; // 选项或回答json {text: '', correct: true}

    public $analyze; // 分析
    public $answer; // 解答
    public $comment; // 点评

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'difficult', 'chapter_id', 'title'], 'required'],
            [['type', 'chapter_id', 'origin_exam_id'], 'integer'],
            ['type', 'in', 'range' => array_keys(BskQuestion::types()) ],
            ['difficult', 'double', 'min' => 0, 'max' => 1],
            [['id', 'point_ids', 'info', 'analyze', 'answer', 'comment'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '题型',
            'difficult' => '难度系数',
            'chapter_id' => '试题章节',
            'origin_exam_id' => '来源试卷',
            'point_ids' => '试题考点',
            'title' => '题干',
            'info' => '选项或答案',
            'analyze' => '分析',
            'answer' => '解答',
            'comment' => '点评',
        ];
    }
}

