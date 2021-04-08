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

    
    // POSTで取得した値を変数に転換
    session_start();
    $_SESSION['model_num'] = $_POST['model_num'];
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['productName'] = $_POST['product_name'];
    $_SESSION['total_amount'] = $_POST['total_amount'];
    $_SESSION['shop_amount'] = $_POST['shop_amount'];
    $_SESSION['warehouse_amount'] = $_POST['warehouse_amount'];
    $_SESSION['waiting_amount'] = $_POST['waiting_amount'];
    $_SESSION['threshold'] = $_POST['threshold'];

    
?>
<!-- // 表形式で数値を記入 -->
<h1>確認画面</h1>    
<div class="table-wrapper">
    <table class="sub-table">
        <tr>
            <td class="table-left">商品番号</td>
            <td><?=$_SESSION['model_num']?></td>
        </tr>
        <tr>
            <td class="table-left">商品名</td>
            <td><?=$_SESSION['productName']?></td>
        </tr>
        <tr>
            <td class="table-left">在庫総数</td>
            <td><?=$_SESSION['total_amount']?></td>
        </tr>
        <tr>
            <td class="table-left">店舗内在庫</td>
            <td><?=$_SESSION['shop_amount']?></td>
        </tr>
        <tr>
            <td class="table-left">倉庫内在庫</td>
            <td><?=$_SESSION['warehouse_amount']?></td>
        </tr>
        <tr>
            <td class="table-left">納品待ち</td>
            <td><?=$_SESSION['waiting_amount']?></td>
        </tr>
        <tr>
            <td class="table-left">発注しきい値</td>
            <td><?=$_SESSION['threshold']?></td>
        </tr>
    </table>
</div>
<div class="btn-wrapper">
    <button onclick="location.href='07-5. renew insert.php'" class="btn regBtn">送信</button>
</div>
<div class="btn-wrapper">
    <button class="btn backBtn" onclick="location.href='javascript:history.back()'">前のページへ戻る</button><br>
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>

    
</body>
</html>