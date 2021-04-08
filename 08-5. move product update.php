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

<h1>登録が完了しました。</h1>
<a href="05-1. choice used product category.php">入力画面へ戻る</a>
<a href="index.html">トップページへ戻る</a>


<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");

// 前ページからの変数の受け取り
    session_start();
    $model_num = $_SESSION['model_num'];
    $category = $_SESSION['category'];
    $productName = $_SESSION['productName'];
    $total_amount = $_SESSION['total_amount'];
    $shop_amount = $_SESSION['shop_amount'];
    $warehouse_amount = $_SESSION['warehouse_amount'];
    $waiting_amount = $_SESSION['waiting_amount'];
    $threshold = $_SESSION['threshold'];
    $place_from = $_SESSION['place_from'];
    $place_to = $_SESSION['place_from'];
    $move_amount = $_SESSION['move_amount'];
    $person_in_charge = $_SESSION['person_in_charge'];
    

   
//DB接続
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }



// ①テーブル「move_db」を作成
// 1. SQL文を用意
$stmt = $pdo->prepare(
  "INSERT INTO move_db(id, model_num, product_name, move_amount, place_from, place_to, person_in_charge, indate) 
  VALUE (null, :model_num, :product_name, :move_amount, :place_from, :place_to, :person_in_charge, sysdate())"
  );

//  2. バインド変数を用意
$stmt->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':product_name', $productName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':move_amount', $move_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':place_from', $place_from, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':place_to', $place_to, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':person_in_charge', $person_in_charge, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
$error = $stmt->errorInfo();
exit("ErrorMessage:". print_r($error, true));
}




// ②テーブル「total_db」の「shop_amount」「warehouse_amount」を更新
// A. 
switch ($place_from){
  case "店舗":
  // 1. SQL文を用意
      $stmt = $pdo->prepare(
        "UPDATE total_db SET
            shop_amount = shop_amount - :move_amount,
            warehouse_amount = warehouse_amount + :move_amount
            WHERE model_num='$model_num'"
        );

      //  2. バインド変数を用意
      $stmt->bindValue(':move_amount', $move_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

      //  3. 実行
      $status = $stmt->execute();

      //４．データ登録処理後
      if($status==false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt->errorInfo();
      exit("ErrorMessage:". print_r($error, true));
      }else{
        //完了画面へリダイレクト
        header("location:00. after processing.php");
      
      }
      break;

  case "倉庫";
  // 1. SQL文を用意
      $stmt = $pdo->prepare(
        "UPDATE total_db SET
            shop_amount = shop_amount + :move_amount,
            warehouse_amount = warehouse_amount - :move_amount
            WHERE model_num='$model_num'"
        );

      //  2. バインド変数を用意
      $stmt->bindValue(':move_amount', $move_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

      //  3. 実行
      $status = $stmt->execute();

      //４．データ登録処理後
      if($status==false){
      //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
      $error = $stmt->errorInfo();
      exit("ErrorMessage:". print_r($error, true));
      }else{
        //完了画面へリダイレクト
        header("location:00. after processing.php");
      
      }
      break;



}