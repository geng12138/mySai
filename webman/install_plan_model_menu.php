<?php
/**
 * 计划模板菜单安装脚本
 * 执行方式: php install_plan_model_menu.php
 */

// 从.env文件读取配置
$envFile = __DIR__ . '/.env';
if (file_exists($envFile)) {
    $envContent = file_get_contents($envFile);
    preg_match('/DB_HOST\s*=\s*(.+)/', $envContent, $hostMatch);
    preg_match('/DB_USER\s*=\s*(.+)/', $envContent, $userMatch);
    preg_match('/DB_PASSWORD\s*=\s*(.+)/', $envContent, $passwordMatch);
    preg_match('/DB_NAME\s*=\s*(.+)/', $envContent, $databaseMatch);
    
    $host = trim($hostMatch[1] ?? '127.0.0.1');
    $user = trim($userMatch[1] ?? 'root');
    $password = trim($passwordMatch[1] ?? 'root');
    $database = trim($databaseMatch[1] ?? 'mysai');
} else {
    die("错误: 找不到 .env 文件\n");
}

echo "========================================\n";
echo "数据库配置信息\n";
echo "========================================\n";
echo "主机: $host\n";
echo "用户: $user\n";
echo "数据库: $database\n";
echo "========================================\n\n";

try {
    // 先连接MySQL服务器（不指定数据库）
    $pdo = new PDO("mysql:host=$host;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 选择数据库
    $pdo->exec("USE `$database`");
    echo "数据库连接成功！\n\n";
    
    echo "正在导入计划模板菜单配置...\n";
    
    // 检查菜单是否已存在
    $checkSql = "SELECT COUNT(*) FROM `sa_system_menu` WHERE `id` = 6200";
    $stmt = $pdo->prepare($checkSql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    if ($count > 0) {
        echo "✓ 计划模板菜单已存在，跳过导入\n\n";
    } else {
        // 计划模板管理菜单
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6200, 6000, '0,6000', '计划模板管理', 'ai-manage/planModel', 'IconTemplate', 'ai-manage/planModel', 'system/planModel/index', NULL, 2, 1, 'M', 0, NULL, 1, 2, '计划模板管理模块', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板列表权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6201, 6200, '0,6000,6200', '计划模板列表', '/core/planModel/index', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '获取计划模板列表', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板保存权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6202, 6200, '0,6000,6200', '计划模板保存', '/core/planModel/save', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '新增计划模板', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板更新权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6203, 6200, '0,6000,6200', '计划模板更新', '/core/planModel/update', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '更新计划模板', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板删除权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6204, 6200, '0,6000,6200', '计划模板删除', '/core/planModel/destroy', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '删除计划模板', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板读取权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6205, 6200, '0,6000,6200', '计划模板读取', '/core/planModel/read', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '查看计划模板详情', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板状态改变权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6206, 6200, '0,6000,6200', '计划模板状态改变', '/core/planModel/changeStatus', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '修改计划模板状态', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");

        // 计划模板可用列表权限
        $pdo->exec("INSERT INTO `sa_system_menu` VALUES (6207, 6200, '0,6000,6200', '计划模板可用列表', '/core/planModel/accessPlanModel', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '获取可用计划模板列表', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);");
        
        echo "✓ 计划模板菜单配置导入成功！\n\n";
    }

    echo "========================================\n";
    echo "计划模板菜单导入完成！\n";
    echo "========================================\n\n";
    echo "后续步骤：\n";
    echo "1. 登录系统\n";
    echo "2. 进入【权限 → 角色管理】\n";
    echo "3. 编辑超级管理员角色，勾选【计划模板管理】菜单\n";
    echo "4. 保存后刷新页面即可看到新菜单\n\n";
    
} catch (PDOException $e) {
    echo "错误: " . $e->getMessage() . "\n";
    exit(1);
}
