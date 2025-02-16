<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // データベース接続
    require_once '../config.php';

    // 入力値の取得
    $content = $_POST['content'];

    // 投稿の保存
    $stmt = $db->prepare('INSERT INTO posts (user_id, content, created_at) VALUES (?, ?, NOW())');
    $stmt->execute([$_SESSION['user_id'], $content]);

    header('Location: ../home/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>投稿</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>新しい投稿</h1>
    <form method="post">
        <textarea name="content" required></textarea>
        <button type="submit">投稿</button>
    </form>
</body>
</html>
