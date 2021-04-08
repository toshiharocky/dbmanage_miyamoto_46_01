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
    session_start();    
    $id = $_POST['id'];
    $order_amount = $_POST['order_amount'];
    $model_num = $_POST['model_num'];

    //1.  DB接続します
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=inventory_management;charset=utf8;host=localhost','root','root');
    } catch (PDOException $e) {
        exit('DBConnectError'.$e->getMessage());
    }

    //2．データ表示①（$table）
    //２-1．データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM order_db WHERE id = '$id'");
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
            <td><input type='hidden' name='id' value='$result[id]'>$result[id]</td>
            <td><input type='hidden' name='model_num' value='$result[model_num]'>$result[model_num]</td>
            <td><input type='hidden' name='product_name' value='$result[product_name]'>$result[product_name]</td>
            <td><input type='hidden' name='order_amount' value='$result[order_amount]'>$result[order_amount]</td>
            <td><input type='hidden' name='order_person' value='$result[order_person]'>$result[order_person]</td>
            <td><input type='hidden' name='indate' value='$result[indate]'>$result[indate]</td>
            </tr>
            ";

            $hidden .= "
            <input type='hidden' name='id' value='$result[id]'>
            <input type='hidden' name='model_num' value='$result[model_num]'>
            <input type='hidden' name='product_name' value='$result[product_name]'>
            <input type='hidden' name='order_amount' value='$result[order_amount]'>
            <input type='hidden' name='order_person' value='$result[order_person]'>
            <input type='hidden' name='indate' value='$result[indate]'>
            ";
        }

    }

?>

<!-- 登録情報の記入 -->
<div class="register">
<form action="03-8. order update confirm.php" method="post">
            <fieldset>
                <h2>商品情報修正</h2>
                    <table class="table">
                        <tr>
                            <th>発注ID</th>
                            <th>商品ID</th>
                            <th>商品名</th>
                            <th>発注個数</th>
                            <th>担当者</th>
                            <th>発注時間</th>
                        </tr>
                        <?=$table?>
                    </table>
                <h2>修正内容</h2>
                    発注数：<input type="text" name="order" id="order"><br>
                    担当者：<input type="text" name="order_person" id="order_person"><br>
                    <input type="submit" value="確認" id="submit" class="btn regBtn">
            </fieldset>
</form>
<form action="03-10. order delete confirm.php" method="post">
    <div class="btn-wrapper">
        <?=$hidden?>
        <input type="submit" value="発注内容の削除" class="btn">
    </div>
</form>
</div>

<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>



<script>
    
    $("#submit").on("click", function(){
        // console.log(shop);
        // console.log(warehouse);
        // console.log(shop_warehouse);
        // console.log(total !== shop_warehouse)
    // <!-- 登録ボタン押下時にどれか1つでも記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        if($("#order").val()=="" || $("#order_person").val()==""){
            alert("全ての項目を記入してください");
            return false;
        }
    // <!-- 登録ボタン押下時に商品番号と発注閾値に数字が入力されていない場合は、「商品番号と発注閾値には数字を入力してください」とアラートを出す -->
        else if(isNaN($("#order").val())){
            alert("発注数には数字を入力してください");
            return false;
        }
    // <!-- 登録ボタン押下時に「店舗内在庫」と「倉庫内在庫」の合計が「在庫総数」と同数でない場合は、「店舗内在庫と倉庫内在庫の合計が、在庫総数と一致していません」とアラートを出す -->
        else if(Number($("#order").val()) == 0){
            alert("発注数がゼロの場合は、発注登録を削除してください");
            // console.log(Number($("#total_amount").val()) !== Number($("#shop_amount").val()) + Number($("#warehouse_amount").val()));
            return false;
        }
    })

</script>

</body>
</html>