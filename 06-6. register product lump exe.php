<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>*******</title>
    <!-- css -->
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="inventory.css">
    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");


/**
 * CSVローダー
 *
 * @param string $csvfile CSVファイルパス
 * @param string $mode `sjis` ならShift-JISでカンマ区切り、 `utf16` ならUTF-16LEでタブ区切りのCSVを読む。'utf8'なら文字コード変換しないでカンマ区切り。
 * @return array ヘッダ列をキーとした配列を返す
 */


// DB接続
$pdo = dbconn();

session_start();
$name = $_SESSION['name'];



$records = get_csv($name);
$max = count($records);



for($i = 0; $i <$max; $i++){
    // echo $records[$i]["insert_master"];
    $insert_master = $records[$i]["insert_master"];
    $stmt = $pdo->prepare("$insert_master");
    $status = $stmt->execute();
    if($status==false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error = $stmt->errorInfo();
        exit("ErrorMessage:". print_r($error, true));
      }

    $insert_total_db = $records[$i]["insert_total_db"];
    $stmt_02 = $pdo->prepare("$insert_total_db");
    $status_02 = $stmt_02->execute();
    if($status_02==false){
        //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
        $error_02 = $stmt_02->errorInfo();
        exit("ErrorMessage:". print_r($error_02, true));
      }
      else{
        //完了画面へリダイレクト
        header("location:00-4. after lump.php");
      
      }
    }

// echo $records[0]["﻿カテゴリー"];
// echo $records[0]["商品番号"];
// echo $records[0]["商品名"];
// echo $records[0]["在庫総数"];
// echo $records[0]["店舗内在庫"];
// echo $records[0]["倉庫内在庫"];
// echo $records[0]["納品待ち"];
// echo $records[0]["発注閾値"];
// echo $records[0]["insert_master"];
// echo $records[0]["insert_total_db"];






?>
        


</body>
</html>