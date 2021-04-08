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
<a href="03-1. order.php">入力画面へ戻る</a>
<a href="index.html">トップページへ戻る</a>


<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");

// 前ページからの変数の受け取り
    session_start();
    $model_num = $_SESSION['model_num'];
    $delivery_person = $_SESSION['delivery_person'];
    $productName = $_SESSION['productName'];
    $order = $_SESSION['order'];
    $category = $_SESSION['category'] ;
    $shop_delivery = $_SESSION['shop_delivery'];
    $warehouse_delivery = $_SESSION['warehouse_delivery'];
    $id = $_SESSION['id'];
    $delivery_amount = $_SESSION['delivery_amount'];
    $place = "店舗：$shop_delivery 倉庫：$warehouse_delivery";

   
//DB接続
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }



  

// ①テーブル「total_db」の「waiting_amount」を消し込み、納品場所ごとの個数追加、「total_amount」の追加
// 1. SQL文を用意
$stmt = $pdo->prepare(
    "UPDATE total_db SET
        total_amount = total_amount + :delivery_amount,
        waiting_amount=waiting_amount - :delivery_amount,
        shop_amount = shop_amount + :shop_delivery,
        warehouse_amount = warehouse_amount + :warehouse_delivery
        WHERE model_num='$model_num'"
    );

//  2. バインド変数を用意
$stmt->bindValue(':delivery_amount', $delivery_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':shop_delivery', $shop_delivery, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':warehouse_delivery', $warehouse_delivery, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}



// ②テーブル「order_db」のステータス更新、担当者記入、納品先の
// 1. SQL文を用意
$stmt_02 = $pdo->prepare(
    "UPDATE order_db SET
        status = :status,
        delivery_person = :delivery_person,
        place = :place
        WHERE id='$id'"
    );

//  2. バインド変数を用意
$stmt_02->bindValue(':status', "done", PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':delivery_person', $delivery_person, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':place', $place, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status_02 = $stmt_02->execute();

//４．データ登録処理後
if($status_02==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error_02 = $stmt_02->errorInfo();
  exit("ErrorMessage:". print_r($error_02, true));
}else{
  //完了画面へリダイレクト
  header("location:00. after processing.php");

}


