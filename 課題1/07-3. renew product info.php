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
            <table class='sub-table' style='width:65%'>
                <tr>
                    <td class=register_table style='width:25%'>在庫総数：</td>
                    <td class=register_table style='width:10%'>
                        <input type='text' name='total_amount' id='total_amount' value='$result[total_amount]'>
                    </td>
                </tr>
                <tr>
                    <td class=register_table style='width:25%'>店舗内在庫：</td>
                    <td class=register_table style='width:10%'>
                        <input type='text' name='shop_amount' id='shop_amount' value='$result[shop_amount]'>
                    </td>
                </tr>
                <tr>
                    <td class=register_table style='width:25%'>倉庫内在庫：</td>
                    <td class=register_table style='width:10%'>
                        <input type='text' name='warehouse_amount' id='warehouse_amount' value='$result[warehouse_amount]'>
                    </td>
                </tr>
                <tr>
                    <td class=register_table style='width:25%'>納品待ち：</td>
                    <td class=register_table style='width:10%'>
                        <input type='text' name='waiting_amount' id='waiting_amount' value='$result[waiting_amount]'>
                    </td>
                </tr>
                <tr>
                    <td class=register_table style='width:25%'>発注しきい値：</td>
                    <td class=register_table style='width:10%'>
                        <input type='text' name='threshold' id='threshold' value='$result[threshold]'>
                    </td>
                </tr>
                <input type='hidden' name='category' id='category' value='$result[category]'>
                <input type='hidden' name='model_num' id='category' value='$result[model_num]'>
                <input type='hidden' name='product_name' id='category' value='$result[product_name]'>
            </table>
            ";
        }

    }

?>

<!-- 登録情報の記入 -->
<form action="07-4. renew confirm.php" method="post">
    <div class="register">
            <fieldset>
                <h2>商品情報修正</h2>
                    <table class="table">
                        <tr>
                            <th>商品ID</th>
                            <th>商品名</th>
                        </tr>
                        <?=$table?>
                    </table>
                <h2>修正内容</h2>
                    <?=$info?>
                <input type="submit" value="更新内容確認" id="submit" class="btn regBtn">
            </fieldset>
        </div>
</form>

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
    // <!-- 登録ボタン押下時にどれか1つでも記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        if($("#total_amount").val()=="" || $("#shop_amount").val()=="" || $("#warehouse_amount").val()=="" || $("#waiting_amount").val()=="" || $("#threshold").val()==""){
            alert("全ての項目を記入してください");
            return false;
        }
    // <!-- 登録ボタン押下時に商品番号と発注閾値に数字が入力されていない場合は、「商品番号と発注閾値には数字を入力してください」とアラートを出す -->
        else if(isNaN($("#total_amount").val()) || isNaN($("#shop_amount").val()) || isNaN($("#warehouse_amount").val()) || isNaN($("#waiting_amount").val()) || isNaN($("#threshold").val())){
            alert("商品番号と発注閾値には数字を入力してください");
            return false;
        }
    // <!-- 登録ボタン押下時に「店舗内在庫」と「倉庫内在庫」の合計が「在庫総数」と同数でない場合は、「店舗内在庫と倉庫内在庫の合計が、在庫総数と一致していません」とアラートを出す -->
        else if(Number($("#total_amount").val()) !== Number($("#shop_amount").val()) + Number($("#warehouse_amount").val())){
            alert("店舗内在庫と倉庫内在庫の合計が、在庫総数と一致していません");
            // console.log(Number($("#total_amount").val()) !== Number($("#shop_amount").val()) + Number($("#warehouse_amount").val()));
            return false;
        }
    })

</script>

</body>
</html>