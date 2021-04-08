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
<a href="06-1. register product info.php">入力画面へ戻る</a>
<a href="index.html">トップページへ戻る</a>


<?php
// <!-- funcs.phpの読み込み -->
    require_once("funcs.php");

// 前ページからの変数の受け取り
    session_start();
    // ("000" + a).slice( -3 )
    $model_num = $_SESSION['model_num'];
    $category = $_SESSION['category'];
    $productName = $_SESSION['productName'];
    $total_amount = $_SESSION['total_amount'];
    $shop_amount = $_SESSION['shop_amount'];
    $warehouse_amount = $_SESSION['warehouse_amount'];
    $waiting_amount = $_SESSION['waiting_amount'];
    $threshold = $_SESSION['threshold'];
//DB接続
try {
    //ID:'root', Password: 'root'
    $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }


// ①テーブル「product_num_maseter」に"model_num","category","product_name","threshold"を登録-->
// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT 
    INTO product_num_master(model_num, category, product_name, indate)
    VALUE (:model_num, :category, :product_name, sysdate())"
    );

//  2. バインド変数を用意
$stmt->bindValue(':model_num', $model_num, PDO::PARAM_STR);
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':product_name', $productName, PDO::PARAM_STR);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:". print_r($error, true));
}


// ②テーブル「total_db」に"model_num","category","product_name","threshold"を登録-->


// 1. SQL文を用意
$stmt_02 = $pdo->prepare("INSERT 
    INTO total_db(model_num, category, product_name, total_amount, shop_amount, warehouse_amount, waiting_amount, threshold, indate)
    VALUE (:model_num, :category, :product_name, :total_amount, :shop_amount, :warehouse_amount, :waiting_amount, :threshold, sysdate())"
    );

//  2. バインド変数を用意
$stmt_02->bindValue(':model_num', h($model_num), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':category', h($category), PDO::PARAM_STR); //****************);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':product_name', h($productName), PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)$stmt->bindValue(':', $, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':total_amount', $total_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':shop_amount', $shop_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':warehouse_amount', $warehouse_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':waiting_amount', $waiting_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt_02->bindValue(':threshold', h($threshold), PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

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

// }
