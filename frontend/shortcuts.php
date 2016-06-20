<?php

// 获取年级学科处理
function getDealedGradeSubjects() {
    $ret = [];
    $org = Yii::$app->params['showGradeSubjects'];
    $ret['leveled'] = $org;

    $ret['gradeMap'] = [];
    $ret['subjectMap']= [];
    foreach($org as $i=>$item) {
        $ret['gradeMap'][$item['id']] = $item['name'];
        foreach($item['subjects'] as $j=>$sub) {
            $ret['subjectMap'][$sub['id']] = $sub['name'];

            if ($i === 0 && $j === 0) {
                $ret['first'] = [
                    'g' => $item['id'],
                    's' => $sub['id'],
                    'name' => $item['name'] . $sub['name'],
                ];
            }
        }
    }
    return $ret;
}
