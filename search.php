<?php
//require_once "define02.php";

$area_id = filter_input(INPUT_GET, "area_id");
$ani_type = filter_input(INPUT_GET, "ani_type");
$ani_name = filter_input(INPUT_GET, "ani_name");
$status_id = filter_input(INPUT_GET, "status_id");



define( "DB_DRIVER","mysql");
define( "DB_HOST","localhost");
define( "DB_NAME","MTSKY");
define( "DB_USER","mtsky");
define( "DB_PASS","sky");
define( "DB_CHRSET","utf8mb4");


// ANDをどうするか

try {
    // DBへ接続
    $driver = DB_DRIVER;
    $host = DB_HOST;
    $dbName = DB_NAME;
    $charset = DB_CHRSET;
  
    $db = new PDO("{$driver}:host={$host};dbname={$dbName};charaset={$charset}", DB_USER,DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    // whereの作成
    $where = "";
    if($area_id) {
    $where .= " AREA_ID = :area_id ";
    }

    if($ani_type) {
        if( !empty($where)) {
            $where .= " AND "; 
        }
    $where .= " ANI_TYPE = :ani_type ";
    }

    if($ani_name) {
        if( !empty($where)) {
            $where .= " AND "; 
        }
    $where .= " ANI_TYPE = :ani_type ";
    }

    if($ani_type) {
        if( !empty($where)) {
            $where .= " AND "; 
        }
    $where .= " ANI_TYPE = :ani_type ";
    }


    if( !empty($where) ) {
    $where = " WHERE ". "$where";
    }

    // DBへSQLの実行
    $sql = "SELECT * FROM ANIMALS {$where}";
    $stmt = $db->prepare($sql);

    $stmt->execute();

    // 3. SQLの結果を処理
    //$rows = [];
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }

    //jsonとして出力
    header('Content-type: application/json');
    echo json_encode($rows, JSON_UNESCAPED_UNICODE);



  }catch(PDOException $e) {
      print $e->getMessage();
  }
  


?>