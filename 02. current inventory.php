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

     //1.  DB接続します
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }

    //２．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM total_db ORDER BY model_num ASC");
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
            $product .= 
            "<tr>
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
// }
?>

<h1>在庫状況一覧</h1>
    <table class="table" style="width:90%">
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
        <?=$product?>
    </table>
    <div class="btn-wrapper">
        <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
    </div>


</body>
</html>