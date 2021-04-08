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
    $model_num = $_SESSION['model_num'];
    
    //DB接続
    try {
        //ID:'root', Password: 'root'
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
    }



    //２．データ取得SQL作成
    $stmt_0x = $pdo->prepare("SELECT * FROM total_db WHERE model_num='$model_num'");
    $status_0x = $stmt_0x->execute();

    //３．データ表示
    $after = "";
    if ($status_0x == false) {
        //execute（SQL実行時にエラーがある場合）
        $error_0x = $stmt_0x->errorInfo();
        exit('ErrorQuery:' . print_r($error_0x, true));
    }else{
        //Selectデータの数だけ自動でループしてくれる
        //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
        while( $result = $stmt_0x->fetch(PDO::FETCH_ASSOC)){
            $after .= 
            "
            <tr>
                <td>$result[category]</td>
                <td>$result[model_num]</td>
                <td>$result[product_name]</td>
                <td>$result[total_amount]</td>
                <td>$result[shop_amount]</td>
                <td>$result[warehouse_amount]</td>
                <td>$result[waiting_amount]</td>
                <td>$result[threshold]</td>
            </tr>";
    }

  }

?>

<h1>登録が完了しました</h1>
<h2>変更後の在庫状況</h2>
<table class="result-table">
        <tr>
            <th>カテゴリー</th>
            <th>商品ID</th>
            <th>商品名</th>
            <th>在庫総数</th>
            <th>店舗内在庫</th>
            <th>倉庫内在庫</th>
            <th>納品待ち</th>
            <th>発注しきい値</th>
        </tr>
        <?=$after?>
    </table>
<div class="btn-wrapper">
    <a href="index.html" class="link">トップページへ戻る</a>
</div>

</body>
</html>
