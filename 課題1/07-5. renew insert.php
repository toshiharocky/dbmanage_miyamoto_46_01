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



  

// テーブル「total_db」を更新
// model_num=:model_num, category=:category,
//         product_name=:product_name, 
// 1. SQL文を用意
$stmt = $pdo->prepare(
    "UPDATE total_db SET
    total_amount=:total_amount,
        shop_amount=:shop_amount, warehouse_amount=:warehouse_amount,
        waiting_amount=:waiting_amount, threshold=:threshold,
        indate=sysdate() 
        WHERE model_num='$model_num'"
    );

//  2. バインド変数を用意
$stmt->bindValue(':total_amount', $total_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':shop_amount', $shop_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':warehouse_amount', $warehouse_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':waiting_amount', $waiting_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':threshold', $threshold, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

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



