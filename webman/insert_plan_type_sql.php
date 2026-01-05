<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=mysai;charset=utf8mb4', 'root', 'root');
$stmt = $pdo->prepare('INSERT INTO sa_plan_type (title, project_id, type_logo, font_url, sort, is_display, status, created_by, updated_by, create_time, update_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())');
$stmt->execute(['类型A', 1, 'logo_a', '/type/a', 1, 1, 1, 1, 1]);
$stmt->execute(['类型B', 1, 'logo_b', '/type/b', 2, 1, 1, 1, 1]);
$stmt->execute(['类型C', 1, 'logo_c', '/type/c', 3, 1, 1, 1, 1]);
echo "已插入3条测试数据\n";