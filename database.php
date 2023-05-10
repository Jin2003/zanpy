<?php
// データベース接続の設定
$host = 'localhost';
$dbname = 'mtsky';
$user = 'mtsky';
$password = 'mtsky';

// PDOインスタンスの作成
function make_PDO($host, $dbname, $user, $password)
{
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('接続エラー:' . $e->getMessage());
    }
}
// データの編集・操作例

// データの取得（SELECT文の例）
function SELECT extends make_PDO($table,$colum){
    try {
        $stmt = $pdo->query('SELECT * FROM'+$table);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // データを表示するなどの処理
            echo $row[$colum];
        }
    } catch (PDOException $e) {
        die('SELECTクエリエラー:' . $e->getMessage());
    }
}

// データの追加（INSERT文の例）
try {
    $stmt = $pdo->prepare('INSERT INTO テーブル名 (カラム名1, カラム名2) VALUES (:value1, :value2)');
    $stmt->bindParam(':value1', $value1);
    $stmt->bindParam(':value2', $value2);

    // 値の設定
    $value1 = '値1';
    $value2 = '値2';

    $stmt->execute();
    echo 'データが追加されました。';
} catch (PDOException $e) {
    die('INSERTクエリエラー:' . $e->getMessage());
}

// データの更新（UPDATE文の例）
try {
    $stmt = $pdo->prepare('UPDATE テーブル名 SET カラム名 = :value WHERE 条件');
    $stmt->bindParam(':value', $value);

    // 値の設定
    $value = '新しい値';

    $stmt->execute();
    echo 'データが更新されました。';
} catch (PDOException $e) {
    die('UPDATEクエリエラー:' . $e->getMessage());
}

// データの削除（DELETE文の例）
try {
    $stmt = $pdo->prepare('DELETE FROM テーブル名 WHERE 条件');
    $stmt->execute();
    echo 'データが削除されました。';
} catch (PDOException $e) {
    die('DELETEクエリエラー:' . $e->getMessage());
}

// データベース接続の解放
$pdo = null;
