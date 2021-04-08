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
    session_start();
    $_SESSION['name'] = 'csv/'.$_POST['name'];
    // echo $_SESSION['name'];
    $name = $_SESSION['name'];


    $records = get_csv($name);
    $max = count($records);
    $table = "";
    


    for($i = 0; $i <$max; $i++){
        $num = $records[$i]['商品番号'];
        $product_name = $records[$i]['商品名'];
        $inv_num = $records[$i]['在庫総数'];
        $shop_inv = $records[$i]['店舗内在庫'];
        $wh_inv = $records[$i]['倉庫内在庫'];
        $wait = $records[$i]['納品待ち'];
        $threshold = $records[$i]['発注閾値'];
        echo $category;
        $table .= "<tr>
                    <td>$num</td>
                    <td>$product_name</td>
                    <td>$inv_num</td>
                    <td>$shop_inv</td>
                    <td>$wh_inv</td>
                    <td>$wait</td>
                    <td>$threshold</td>            
                </tr>";
    }

    // echo $records[0]["﻿カテゴリー"];
    // echo $records[0]["商品番号"];
    // echo $records[0]["商品名"];
    // echo $records[0]["在庫総数"];
    // echo $records[0]["店舗内在庫"];
    // echo $records[0]["倉庫内在庫"];
    // echo $records[0]["納品待ち"];
    // echo $records[0]["発注閾値"];
    // echo $records[0]["insert_master"];
    // echo $records[0]["insert_total_db"];


?>

<h1>確認画面</h1>    
<div class="table-wrapper"> 
    <table style="margin: 0 auto">
        <tr>
            <th class="table_left">商品ID</th>
            <th class="table_left">商品名</th>
            <th class="table_left">在庫総数</th>
            <th class="table_left">店舗内在庫</th>
            <th class="table_left">倉庫内在庫</th>
            <th class="table_left">納品待ち</th>
            <th class="table_left">発注閾値</th>
        </tr>
        <!-- <tr>
            
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>        
        </tr> -->
        <?=$table?>
    </table>
</div>

<div class="btn-wrapper">
    <button class="btn regBtn" onclick="location.href='06-6. register product lump exe.php'" class="btn regBtn">商品を登録</button>
</div>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>
</body>
</html>