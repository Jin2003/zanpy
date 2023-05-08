<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="signin">
        <form action="login.php" method="POST">
            <label for="signin-id">ユーザーID</label>
            <input id="signin-id" name="username" type="text" placeholder="ユーザーIDを入力">
            <label for="signin-pass">パスワード</label>
            <input id="signin-pass" name="password" type="text" placeholder="パスワードを入力">
            <button name="signin" type="submit">ログインする</button>
        </form>
    </div>
</body>
</html>