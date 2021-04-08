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
    $_SESSION['id'] = $_POST['id'];
    $_SESSION['model_num'] = $_POST['model_num'];
    $_SESSION['product_name'] = $_POST['product_name'];
    $_SESSION['order_amount'] = $_POST['order_amount'];
    $_SESSION['order_person'] = $_POST['order_person'];
    $_SESSION['indate'] = $_POST['indate'];
    $_SESSION['order'] = $_POST['order'];
    $_SESSION['order_person'] = $_POST['order_person'];
    
    
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
            <td><?=$_SESSION['product_name']?></td>
        </tr>
        <tr>
            <td class="table-left">変更前発注数</td>
            <td><?=$_SESSION['order_amount']?></td>
        </tr>
        <tr>
            <td class="table-left">変更後発注数</td>
            <td><?=$_SESSION['order']?></td>
        </tr>
        <tr>
            <td class="table-left">担当者</td>
            <td><?=$_SESSION['order_person']?></td>
        </tr>
    </table>
</div>
<div class="btn-wrapper">
    <button onclick="location.href='03-9. order update exe.php'" class="btn regBtn">送信</button>
</div>
<div class="btn-wrapper">
    <button class="btn backBtn" onclick="location.href='javascript:history.back()'">前のページへ戻る</button><br>
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>

    
</body>
</html>