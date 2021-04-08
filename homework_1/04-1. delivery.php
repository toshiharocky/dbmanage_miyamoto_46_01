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
    // 変数の受け取り
        $category = $_POST['category'];
        echo $category;
        // categorySelect($category);


    //1.  DB接続します
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }

    //２．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM order_db WHERE status = 'waiting'");
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
            <td><input type='submit' name='id' value='$result[id]'></td>
            <td>$result[model_num]</td>
            <td>$result[product_name]</td>
            <td>$result[order_amount]</td>
            <td>$result[order_person]</td>
            <td>$result[indate]</td>
            </tr>";
        }

}
// }
?>
<h1>納品登録</h1>
<h2>納品する商品を選択してください</h2>
<form action="04-2. delivery info.php" method="post">
    <table class="table">
        <tr>
            <th>発注ID</th>
            <th>商品ID</th>
            <th>商品名</th>
            <th>発注個数</th>
            <th>担当者</th>
            <th>発注時間</th>
        </tr>
        <?=$product?>
    </table>
</form>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>

</body>
</html>