<?php
require_once __DIR__ . '/vendor/autoload.php';

use plugin\saiadmin\app\model\system\SystemPlanType;

$count = (new SystemPlanType())->count();
if($count == 0) {
    // 插入测试数据
    $testData = [
        ['title' => '类型A', 'project_id' => 1, 'type_logo' => 'logo_a', 'font_url' => '/type/a', 'sort' => 1, 'is_display' => 1, 'status' => 1],
        ['title' => '类型B', 'project_id' => 1, 'type_logo' => 'logo_b', 'font_url' => '/type/b', 'sort' => 2, 'is_display' => 1, 'status' => 1],
        ['title' => '类型C', 'project_id' => 1, 'type_logo' => 'logo_c', 'font_url' => '/type/c', 'sort' => 3, 'is_display' => 1, 'status' => 1]
    ];
    foreach($testData as $data) {
        (new SystemPlanType())->save($data);
    }
    echo "已插入3条测试数据\n";
} else {
    echo "计划类型表已有 " . $count . " 条数据\n";
}