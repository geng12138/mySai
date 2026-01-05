<?php
/**
 * 数据库安装脚本
 * 执行方式: php install_db.php
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
    
    // 创建数据库（如果不存在）
    echo "正在检查数据库...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ 数据库检查完成！\n\n";
    
    // 选择数据库
    $pdo->exec("USE `$database`");
    echo "数据库连接成功！\n\n";
    
    // 执行第一个SQL文件：创建表
    echo "正在导入数据表结构...\n";
    $sql1 = file_get_contents(__DIR__ . '/plugin/saiadmin/db/update5.1.2.sql');
    $pdo->exec($sql1);
    echo "✓ 数据表创建成功！\n\n";
    
    // 执行第二个SQL文件：导入菜单
    echo "正在导入菜单配置...\n";
    $sql2 = file_get_contents(__DIR__ . '/plugin/saiadmin/db/menu_ai_plantype.sql');
    $pdo->exec($sql2);
    echo "✓ 菜单配置导入成功！\n\n";
    
    echo "========================================\n";
    echo "所有数据导入完成！\n";
    echo "========================================\n\n";
    echo "后续步骤：\n";
    echo "1. 登录系统\n";
    echo "2. 进入【权限 → 角色管理】\n";
    echo "3. 编辑超级管理员角色，勾选【AI新建管理】菜单\n";
    echo "4. 保存后刷新页面即可看到新菜单\n\n";
    
} catch (PDOException $e) {
    echo "错误: " . $e->getMessage() . "\n";
    exit(1);
}
