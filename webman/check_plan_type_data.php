<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=mysai;charset=utf8mb4', 'root', 'root');
$stmt = $pdo->query('SELECT id, title FROM sa_plan_type WHERE status = 1');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "计划类型数据：\n";
foreach($results as $row) {
    echo 'ID: ' . $row['id'] . ', 标题: ' . $row['title'] . "\n";
}