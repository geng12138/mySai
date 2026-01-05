<?php
require_once __DIR__ . '/vendor/autoload.php';

// 模拟请求环境
$_GET = ['saiType' => 'all']; // 获取全部数据
$_POST = [];

use plugin\saiadmin\app\logic\system\SystemPlanTypeLogic;
$logic = new SystemPlanTypeLogic();
$result = $logic->accessPlanType(['status' => 1]);
echo "API返回的数据：\n";
var_dump($result);