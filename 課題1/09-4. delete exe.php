<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");

// 前ページからの変数の受け取り
    session_start();
    // ("000" + a).slice( -3 )
    $model_num = $_SESSION['model_num'];

   
//DB接続
$pdo = dbconn();

// テーブル「total_db」から削除
// 1. SQL文を用意
$stmt = $pdo->prepare(
    "DELETE FROM total_db 
        WHERE model_num=:model_num"
    );

//  2. バインド変数を用意
$stmt->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INTR)
//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}

// テーブル「product_num_master」から削除
// 1. SQL文を用意
$stmt = $pdo->prepare(
    "DELETE FROM product_num_master 
        WHERE model_num=:model_num"
    );

//  2. バインド変数を用意
$stmt->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INTR)
//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}else{
  //完了画面へリダイレクト
  redirect("00-2. after deletion.php");

}
