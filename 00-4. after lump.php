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
    session_start();
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
?>

<h1>登録が完了しました</h1>
<h2>変更後の在庫状況</h2>
<table class="result-table">
        <tr>
            <th>商品ID</th>
            <th>商品名</th>
            <th>在庫総数</th>
            <th>店舗内在庫</th>
            <th>倉庫内在庫</th>
            <th>納品待ち</th>
            <th>発注しきい値</th>
        </tr>
        <?=$table?>
    </table>
<div class="btn-wrapper">
    <a href="index.html" class="link">トップページへ戻る</a>
</div>

</body>
</html>
