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
    $id =$_POST['id'];
    // echo $id;
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
    $stmt = $pdo->prepare("SELECT * FROM order_db WHERE id = $id");
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
            <td>$result[id]</td>
            <td>$result[model_num]</td>
            <td>$result[product_name]</td>
            <td>$result[order_person]</td>
            <td>$result[indate]</td>
            </tr>";

            $productInfo .= 
            "<input type='hidden' name='model_num' value=$result[model_num]>
            <input type='hidden' name='product_name' value=$result[product_name]>
            <input type='hidden' name='id' value=$result[id]>
            <input type='hidden' name='category' value=$result[category]>
            <tr>
                <td class=register_table>納品数：</td>
                <td class=register_table>
                    <input type='text' class = 'register_input' name='delivery_amount' id='delivery_amount' value=$result[order_amount] readonly>
                </td>
            </tr>";
        }

    }

?>

<!-- 登録情報の記入 -->
    <div class="register">
            <fieldset>
                <h2>納品情報登録</h2>
                    <table class="table">
                        <tr>
                            <th>発注ID</th>
                            <th>商品ID</th>
                            <th>商品名</th>
                            <th>担当者</th>
                            <th>発注時間</th>
                        </tr>
                        <?=$table?>
                    </table>
                </h2>
            </fieldset>
        </div>
<form action="04-3. delivery confirm.php" method="post">
<div class="input-wrapper">
    <table class="sub-table">
        <?=$productInfo?>
        <tr>
            <td class=register_table>店舗納品数：</td>
            <td class=register_table>
                <input type="text" class = "register_input" name="shop_delivery" id="shop_delivery">
            </td>
        </tr>
        <tr>
            <td class=register_table>倉庫納品数：</td>
            <td class=register_table>
                <input type="text" class = "register_input" name="warehouse_delivery" id="warehouse_delivery">
            </td>
        </tr>
        <tr>
            <td class=register_table>担当者：</td>
            <td class=register_table>
                <input type="text" class = "register_input" name="delivery_person" id="delivery_person">
            </td>
        </tr>
    </table>
    <input type="submit" value="納品確認" id="submit" class="btn regBtn">
</div>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>
</form>



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
        if($("#shop_delivery").val()=="" || $("#warehouse_delivery").val()=="" || $("#delivery_person").val()==""){
            alert("必要事項を記入してください");
            return false;
        }
    // <!-- 登録ボタン押下時に「店舗納品数」と「倉庫納品数」の合計が「発注数」と同数でない場合は、「店舗納品数と倉庫納品数の合計が、発注数と一致していません」とアラートを出す -->
        else if(Number($("#delivery_amount").val()) !== Number($("#shop_delivery").val()) + Number($("#warehouse_delivery").val())){
            alert("店舗納品数と倉庫納品数の合計が、発注数と一致していません");
            // console.log(Number($("#total_amount").val()) !== Number($("#shop_amount").val()) + Number($("#warehouse_amount").val()));
            return false;
        }
    })

</script>

</body>
</html>