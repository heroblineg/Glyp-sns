<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // データベース接続
    require_once '../config.php';

    // 入力値の取得
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ユーザーの検証
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../home/index.php');
        exit;
    } else {
        $error = 'ユーザー名またはパスワードが間違っています。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>ログイン</h1>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post">
        <label for="username">ユーザー名</label>
        <input type="text" id="username" name="username" required>
        <label for="password">パスワード</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">ログイン</button>
    </form>
</body>
</html>
