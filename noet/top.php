<?php
session_start();
require_once "define02.php";
$user_id = $_SESSION['user_id'];

try {
  // DBへ接続
  $driver = DB_DRIVER;
  $host = DB_HOST;
  $dbName = DB_NAME;
  $charset = DB_CHRSET;

  $db = new PDO("{$driver}:host={$host};dbname={$dbName};charaset={$charset}", DB_USER,DB_PASS);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

}catch(PDOException $e) {
    //print $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>top</title>
</head>
<body>
  <p>Welcome,<?= $user_id?></p>
  <button>ログアウト</button>
</body>
</html>