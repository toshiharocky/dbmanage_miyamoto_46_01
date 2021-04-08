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
    $_SESSION['model_num'] = $_POST['category_num']."-".$_POST['product_num'];
    $_SESSION['category'] = $_POST['category'];
    $_SESSION['productName'] = $_POST['product_name'];
    $_SESSION['total_amount'] = $_POST['total_amount'];
    $_SESSION['shop_amount'] = $_POST['shop_amount'];
    $_SESSION['warehouse_amount'] = $_POST['warehouse_amount'];
    $_SESSION['waiting_amount'] = $_POST['waiting_amount'];
    $_SESSION['threshold'] = $_POST['threshold'];

    $model_num = $_SESSION['model_num'];
    $category = $_SESSION['category'];
    $productName = $_SESSION['productName'];
    $total_amount = $_SESSION['total_amount'];
    $shop_amount = $_SESSION['shop_amount'];
    $warehouse_amount = $_SESSION['warehouse_amount'];
    $waiting_amount = $_SESSION['waiting_amount'];
    $threshold = $_SESSION['threshold'];
    
?>
<!-- // 表形式で数値を記入 -->
<h1>確認画面</h1>    
<div class="table-wrapper"> 
<table class="sub-table">
    <tr>
        <td class="table-left">商品番号</td>
        <td><?=h($model_num)?></td>
    </tr>
    <tr>
        <td class="table-left">カテゴリー</td>
        <td><?=h($category)?></td>
    </tr>
    <tr>
        <td class="table-left">商品名</td>
        <td><?=h($productName)?></td>
    </tr>
    <tr>
        <td class="table-left">在庫総数</td>
        <td><?=h($total_amount)?></td>
    </tr>
    <tr>
        <td class="table-left">店舗内在庫</td>
        <td><?=h($shop_amount)?></td>
    </tr>
    <tr>
        <td class="table-left">倉庫内在庫</td>
        <td><?=h($warehouse_amount)?></td>
    </tr>
    <tr>
        <td class="table-left">納品待ち</td>
        <td><?=h($waiting_amount)?></td>
    </tr>
    <tr>
        <td class="table-left">発注しきい値</td>
        <td><?=h($threshold)?></td>
    </tr>
</table>

<div class="btn-wrapper">
    <button onclick="location.href='06-3. register insert.php'">送信</button>
</div>
<div class="btn-wrapper">
    <button class="btn backBtn" onclick="location.href='javascript:history.back()'">前のページへ戻る</button><br>
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>
    
</body>
</html>