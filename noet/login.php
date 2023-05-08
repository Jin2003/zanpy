<?php
session_start();
require_once "define02.php";

// POST
// user_id
$user_id = filter_input(INPUT_POST, "username");
// password
$password = filter_input(INPUT_POST, "password");

$_SESSION['user_id'] = filter_input(INPUT_POST, "username");

//user_idが無いとき
if( !$user_id ) {
  // main.phpへリダイレクト
  header( "Location: main.php");
  exit;
}


try {
  // DBへ接続
  $driver = DB_DRIVER;
  $host = DB_HOST;
  $dbName = DB_NAME;
  $charset = DB_CHRSET;

  $db = new PDO("{$driver}:host={$host};dbname={$dbName};charaset={$charset}", DB_USER,DB_PASS);
  $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

  // Mysqlのデータベースからユーザ―情報を取得
  $table = "users";
  $sql = "SELECT * FROM {$table} WHERE USER_ID = :username"; //

  $stmt = $db->prepare($sql);
  $stmt->bindParam( ":username", $user_id, PDO::PARAM_STR );

  // ステートメントの実行

  $stmt->execute();

  $row = $stmt->fetch( PDO::FETCH_ASSOC); 

  // IDとpasswrodが合致していればトップ画面へ
  if($row["password"] == $password) {
    header( "Location: top.php");
    exit;    
  } else {
    header( "Location: main.php");
    exit;    
  } 
  
} catch(PDOException $e) {
    //print $e->getMessage();
}

?>
