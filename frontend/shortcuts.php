<?php
use yii\helpers\ArrayHelper;
use common\models\BskAdPosition;
use common\models\BskAdContent;

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

// 获取广告位数据
function getAds($keys) {
    $ret = [];
    $keys = is_string($keys) ? [$keys] : $keys;
    // 获取位置IDs
    $positions = BskAdPosition::find()->select('id,key')->andWhere(['key'=>$keys])->all();
    if (empty($positions)) return $ret;
    $positionMap = ArrayHelper::map($positions, 'id', 'key');

    // 获取广告内容
    $pids = ArrayHelper::getColumn($positions, 'id');
    $ads = BskAdContent::find()
        ->select('position_id, image_path, image_base_url, text1, text2, text3, url, weight')
        ->andWhere(['position_id' => $pids])
        ->orderBy(['position_id' => SORT_ASC, 'weight' => SORT_DESC, 'created_at' => SORT_DESC])
        ->all();
    foreach($ads as $item) {
        $key = $positionMap[$item->position_id];
        if (!isset($ret[$key])) $ret[$key] = [];
        $ret[$key][] = $item;
    }

    return $ret;
}
