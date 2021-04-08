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
    $model_num =$_POST['model_num'];
    // echo $model_num;
// 商品名が表示されると、登録されている「商品番号」「在庫総数」「店舗内在庫」「倉庫内在庫」「納品待ち」「発注しきい値」が表示される
    //1.  DB接続します
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }

    //2．データ表示①（$table）
    //２-1．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM total_db WHERE model_num = '$model_num'");
    $status = $stmt->execute();

    //2-2．データ表示
    $table = "";
    if ($status == false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit('ErrorQuery:' . print_r($error, true));
    }else{
        //Selectデータの数だけ自動でループしてくれる
        //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $table .= 
            "<tr>
            <td>$result[model_num]</td>
            <td>$result[product_name]</td>
            </tr>";

            $productInfo .= 
            "<input type='hidden' name='model_num' value=$result[model_num]>
            <input type='hidden' name='product_name' value=$result[product_name]>
            <input type='hidden' name='category' value=$result[category]>";
        }

    }

    //3．データ表示②（$info）
    //3-1．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM total_db WHERE model_num = '$model_num'");
    $status = $stmt->execute();

    //3-2．データ表示②（$info）
    $info = "";
    if ($status == false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit('ErrorQuery:' . print_r($error, true));
    }else{
        //Selectデータの数だけ自動でループしてくれる
        //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            $info .= 
            "
            <h4>在庫状況</h4>
            <table class='table sub-table'>
                <tr>
                    <td class='table-left'>在庫総数</td>
                    <td>$result[total_amount]</td>
                </tr>
                <tr>
                    <td class='table-left'>店舗内在庫</td>
                    <td>$result[shop_amount]</td>
                </tr>
                <tr>
                    <td class='table-left'>倉庫内在庫</td>
                    <td>$result[warehouse_amount]</td>
                </tr>
                <tr>
                    <td class='table-left'>納品待ち</td>
                    <td>$result[waiting_amount]</td>
                </tr>
                <tr>
                    <td class='table-left'>発注しきい値</td>
                    <td>$result[threshold]</td>
                </tr>
            </table>";
        }

    }

?>

<!-- 登録情報の記入 -->
    <div class="register">
            <fieldset>
                <h2>発注する商品情報</h2>
                    <table class="table">
                        <tr>
                            <th>商品ID</th>
                            <th>商品名</th>
                        </tr>
                        <?=$table?>
                    </table>
                    <?=$info?>
                </h1>
            </fieldset>
        </div>
<div class="input-wrapper">
    <form action="03-4. order confirm.php" method="post">
        発注数：<input type="text" name="order" id="order"><br>
        担当者：<input type="text" name="order_person" id="order_person">
        <?=$productInfo?><br>
        <input type="submit" value="発注内容の確認" id="submit" class="btn regBtn">
    </form>
</div>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>


<script>
    let total = 0;
    let shop = 0;
    let warehouse = 0;
    let shop_warehouse = 0;

    
       

    // $("total_amount").change(function() {
    //     total = Number($(this).val());
    //     console.log(total);
    // })

    // $("shop_amount").change(function() {
    //     shop = Number($(this).val());
    //     console.log(shop);
    // })

    // $("warehouse_amount").change(function() {
    //     warehouse = Number($(this).val());
    //     console.log(warehouse);
    // })
    
    $("#submit").on("click", function(){
        // console.log(shop);
        // console.log(warehouse);
        // console.log(shop_warehouse);
        // console.log(total !== shop_warehouse)
    // <!-- 登録ボタン押下時に記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        if($("#order").val()=="" || $("#order_person").val()==""){
            alert("必要事項を記入してください");
            return false;
        }
    })

</script>

</body>
</html>