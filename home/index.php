<?php
// セッション確認
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/index.php');
    exit;
}

// データベース接続
require_once '../config.php';

// タイムラインの投稿を取得
$stmt = $db->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ホーム</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>タイムライン</h1>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?php echo htmlspecialchars($post['content']); ?></p>
            <small><?php echo htmlspecialchars($post['created_at']); ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
