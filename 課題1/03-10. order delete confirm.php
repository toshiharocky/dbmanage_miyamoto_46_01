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
// 変数の受け取り
    session_start();
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['order_amount'] = $_POST['order_amount'];
    $_SESSION['model_num'] = $_POST['model_num'];
    $id = $_SESSION['id'];
    $order_amount = $_SESSION['order_amount'];
    $model_num = $_SESSION['model_num'];

// db接続
$pdo = dbconn();

// 削除対象発注の表示
//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM order_db WHERE id = '$id'");
$status = $stmt->execute();

//３．データ表示
$product = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit('ErrorQuery:' . print_r($error, true));
}else{
    //Selectデータの数だけ自動でループしてくれる
    //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $delete_confirm .= 
        "
        <tr>
            <td><input type='hidden' name='id' value='$id'>$id</td>
            <td><input type='hidden' name='model_num' value='$model_num'>$result[model_num]</td>
            <td>$result[product_name]</td>
            <td><input type='hidden' name='order_amount' value='$order_amount'>$result[order_amount]</td>
            <td>$result[order_person]</td>
            <td>$result[indate]</td>
        </tr>
        ";
    }

}



    

    
?>

<!-- 登録情報の記入 -->
<div class="register">
<form action="03-11. order delete exe.php" method="post">
            <fieldset>
                <h2>発注登録削除</h2>
                <h4>以下の発注登録を削除しますか？</h4>
                    <table class="table">
                        <tr>
                            <th>発注ID</th>
                            <th>商品ID</th>
                            <th>商品名</th>
                            <th>発注個数</th>
                            <th>担当者</th>
                            <th>発注時間</th>
                        </tr>
                        <?=$delete_confirm?>
                    </table>
                    <div class="btn-wrapper">
                        <input type="submit" value="削除" id="submit" class="btn delBtn">
                    </div>
            </fieldset>
</form>
</div>

<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>



</body>
</html>