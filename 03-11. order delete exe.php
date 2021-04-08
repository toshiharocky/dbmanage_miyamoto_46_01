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
   
//DB接続
$pdo = dbconn();

// 変数の受け取り
session_start();
$_SESSION['id'] = $_POST['id'];
$_SESSION['order_amount'] = $_POST['order_amount'];
$_SESSION['model_num'] = $_POST['model_num'];
$order_amount = $_SESSION['order_amount'];
$id = $_SESSION['id'];
$model_num = $_SESSION['model_num'];
// db接続
$pdo = dbconn();



// ①「order_db」からの削除
//２．データ取得SQL作成
$stmt = $pdo->prepare("DELETE FROM order_db WHERE id = '$id'");
$status = $stmt->execute();

//３．データ表示
$product = "";
if ($status == false) {
//execute（SQL実行時にエラーがある場合）
$error = $stmt->errorInfo();
exit('ErrorQuery:' . print_r($error, true));
}

// ②テーブル「total_db」の「waiting_amount」の更新
// 1. SQL文を用意
$stmt2 = $pdo->prepare(
"UPDATE total_db SET
    waiting_amount=waiting_amount - :order_amount
    WHERE model_num=:model_num"
);

//  2. バインド変数を用意
$stmt2->bindValue(':order_amount', $order_amount, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt2->bindValue(':model_num', $model_num, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)

//  3. 実行
$status2 = $stmt2->execute();

//４．データ登録処理後
if($status2==false){
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
$error_2 = $stmt2->errorInfo();
exit("ErrorMessage:". print_r($error_2, true));
}else{
  //完了画面へリダイレクト
  redirect("00-3. after order deletion.php");

}
