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
<a href="07-1. choice category.php">入力画面へ戻る</a>
<a href="index.html">トップページへ戻る</a>


<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");

// 前ページからの変数の受け取り
    session_start();
    $id = $_SESSION['id'] ;
    $model_num = $_SESSION['model_num'] ;
    $product_name = $_SESSION['product_name'] ;
    $order_amount = $_SESSION['order_amount'] ;
    $order = $_SESSION['order'];
    $order_person = $_SESSION['order_person'];
    $dif = $order - $order_amount;
   
//DB接続
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }



  

// ①テーブル「total_db」の「waiting_amount」の更新
// 1. SQL文を用意
$stmt = $pdo->prepare(
  "UPDATE total_db SET
      waiting_amount=waiting_amount + :dif
      WHERE model_num=:model_num"
  );

//  2. バインド変数を用意
$stmt->bindValue(':dif', $dif, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
$error = $stmt->errorInfo();
exit("ErrorMessage:". print_r($error, true));
}



// ②テーブル「order_db」のorder_amountとdelivery_personの更新
// 1. SQL文を用意
$stmt_02 = $pdo->prepare(
  "UPDATE order_db SET
      order_person = :order_person,
      order_amount = :order,
      indate = sysdate()
      WHERE id=:id"
  );

//  2. バインド変数を用意
$stmt_02->bindValue(':order_person', $order_person, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':order', $order, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

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
