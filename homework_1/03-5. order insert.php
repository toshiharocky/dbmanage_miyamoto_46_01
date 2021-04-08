<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

// 前ページからの変数の受け取り
    session_start();
    $category = $_SESSION['category'];
    $model_num = $_SESSION['model_num'];
    $productName = $_SESSION['productName'];
    $order = $_SESSION['order'];
    $order_person = $_SESSION['order_person'];

   
//DB接続
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }



  

// ①テーブル「total_db」の「waiting_amount」に追加
// 1. SQL文を用意
$stmt = $pdo->prepare(
    "UPDATE total_db SET
        waiting_amount=waiting_amount + :order
        WHERE model_num='$model_num'"
    );

//  2. バインド変数を用意
$stmt->bindValue(':order', $order, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}



// ②テーブル「order_db」に登録
// 1. SQL文を用意
$stmt_02 = $pdo->prepare("INSERT 
    INTO order_db(id, category, model_num, product_name, indate, order_amount, order_person, status, delivery_person, place)
    VALUE (null, :category, :model_num, :product_name, sysdate(), :order, :order_person, :status, null, null)"
    );

//  2. バインド変数を用意
$stmt_02->bindValue(':category', $category, PDO::PARAM_STR); //****************);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':product_name', $productName, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':order', $order, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':order_person', $order_person, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':status', "waiting", PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

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


?>


</body>
</html>
