<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=mysai;charset=utf8mb4', 'root', 'root');
$stmt = $pdo->query('SELECT id as value, title as label, id, title FROM sa_plan_type WHERE status = 1');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "数据库查询结果：\n";
foreach($results as $row) {
    echo 'value: ' . $row['value'] . ', label: ' . $row['label'] . ', id: ' . $row['id'] . ', title: ' . $row['title'] . "\n";
}