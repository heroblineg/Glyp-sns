<?php
// 招待コードを確認して、招待者の名前を表示
$invite_code = $_GET['code'] ?? null;
if (!$invite_code) {
    die('招待コードが無効です。');
}

// データベース接続
require_once '../config.php';

// 招待コードの検証
$stmt = $db->prepare('SELECT inviter_name FROM invites WHERE code = ?');
$stmt->execute([$invite_code]);
$invite = $stmt->fetch();

if (!$invite) {
    die('招待コードが無効です。');
}

$inviter_name = htmlspecialchars($invite['inviter_name']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>招待されています</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>招待されています</h1>
    <p><?php echo $inviter_name; ?>さんから招待されています。</p>
    <a href="../login/index.php">アカウントを作ります</a>
</body>
</html>
