<?php
// データベース接続関数
function connectDB()
{
    $host = 'localhost';
    $dbname = 'mtsky';
    $user = 'mtsky';
    $password = 'root';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die('接続エラー:' . $e->getMessage());
    }
}

// データベース切断関数
function disconnectDB($pdo)
{
    $pdo = null;
}

// データ取得関数（SELECT文の実行）
function getData($pdo, $table)
{
    try {
        $stmt = $pdo->query("SELECT * FROM $table");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('SELECTクエリエラー:' . $e->getMessage());
    }
}

// データ追加関数（INSERT文の実行）
function insertData($pdo, $table, $data)
{
    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));

    try {
        $stmt = $pdo->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $stmt->execute($data);
        echo 'データが追加されました。';
    } catch (PDOException $e) {
        die('INSERTクエリエラー:' . $e->getMessage());
    }
}

// データ更新関数（UPDATE文の実行）
function updateData($pdo, $table, $data, $condition)
{
    $set = implode(", ", array_map(function ($key) {
        return "$key=:$key";
    }, array_keys($data)));

    try {
        $stmt = $pdo->prepare("UPDATE $table SET $set WHERE $condition");
        $stmt->execute($data);
        echo 'データが更新されました。';
    } catch (PDOException $e) {
        die('UPDATEクエリエラー:' . $e->getMessage());
    }
}

// データ削除関数（DELETE文の実行）
function deleteData($pdo, $table, $condition)
{
    try {
        $stmt = $pdo->prepare("DELETE FROM $table WHERE $condition");
        $stmt->execute();
        echo 'データが削除されました。';
    } catch (PDOException $e) {
        die('DELETEクエリエラー:' . $e->getMessage());
    }
}

// 使用例

// データベースに接続
$pdo = connectDB();

// データの取得
$data = getData($pdo, 'テーブル名');
print_r($data);
