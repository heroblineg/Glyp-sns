<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=sns;charset=utf8mb4', 'username', 'password');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('データベース接続失敗: ' . $e->getMessage());
}
?>
