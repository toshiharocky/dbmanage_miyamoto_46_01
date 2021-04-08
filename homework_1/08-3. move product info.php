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
            </table>
            ";

            $sent .= "<input type='hidden' name='total_amount' id='total_amount' value='$result[total_amount]'>
            <input type='hidden' name='shop_amount' id='shop_amount' value='$result[shop_amount]'>
            <input type='hidden' name='warehouse_amount' id='warehouse_amount' value='$result[warehouse_amount]'>
            <input type='hidden' name='waiting_amount' id='waiting_amount' value='$result[waiting_amount]'>
            <input type='hidden' name='threshold' id='threshold' value='$result[threshold]'>
            <input type='hidden' name='category' id='category' value='$result[category]'>
            <input type='hidden' name='model_num' id='model_num' value='$result[model_num]'>
            <input type='hidden' name='product_name' id='product_name' value='$result[product_name]'>";
        }

    }




?>

<!-- 移動情報の記入 -->

<div class="register">
        <fieldset>
            <h2>移動する商品の情報</h2>
                <table class="table">
                    <tr>
                        <th>商品ID</th>
                        <th>商品名</th>
                    </tr>
                    <?=$table?>
                </table>
                <?=$info?>
        </fieldset>
</div>
<div class="input-wrapper">
    <h2>移動内容</h2>
    <form action="08-4. move product confirm.php" method="post">
        <table class="sub-table">
            <tr>
                <td class=register_table>格納経路：</td>
                <td class=register_table>
                    <select name="place_from" id="place_from">
                        <option value="selected" selected>格納経路を選択</option>
                        <option value="倉庫">倉庫⇨店舗</option>
                        <option value="店舗">店舗⇨倉庫</option>
                    </select><br>
                    <div id="place_to">
                </td>
            </tr>
            <tr>
                <td class=register_table>個数：</td>
                <td class=register_table>
                    <input type="text" name="move_amount" id="move_amount">
                </td>
            </tr>
            <tr>
                <td class=register_table>担当者：</td>
                <td class=register_table>
                <input type="text" name="person_in_charge" id="person_in_charge"><br>
                </td>
            </tr>
        </table>
        <?=$sent?>
        <input type="submit" value="移動内容の確認" id="submit" class="btn regBtn">
    </form>
</div>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>



<script>

    $("#place_from").change(function() {
        switch($(this).val()){                
                case "倉庫":
                    $("#place_to").empty();
                    $("#place_to").append(`<input type="hidden" name="place_to" value="店舗">`);
                    break;
                case "店舗":
                    $("#place_to").empty();
                    $("#place_to").append(`<input type="hidden" name="place_to" value="倉庫">`);
                    break;
            }
    })
    
    $("#submit").on("click", function(){
        // console.log(shop);
    // <!-- 登録ボタン押下時にどれか1つでも記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        if($("#place_from").val()=="selected" || $("#move_amount").val()=="" || $("#person_in_charge").val()==""){
            alert("全ての項目を記入・登録してください");
            return false;
        }
    // <!-- 登録ボタン押下時に使用個数に数字が入力されていない場合は、「使用個数には数字を入力してください」とアラートを出す -->
        else if(isNaN($("#move_amount").val())){
            alert("使用個数には数字を入力してください");
            return false;
        } else {
            switch($("#place_from").val()){
                case "倉庫":
                    if(Number($("#move_amount").val()) > Number($("#warehouse_amount").val())){
                        alert ("移動個数が倉庫内在庫を超過しています");
                        return false;
                    };
                    break;
                case "店舗":
                    if(Number($("#move_amount").val()) > Number($("#shop_amount").val())){
                        alert ("移動個数が店舗内在庫を超過しています");
                        return false;
                    };
                    break;
                }
                    
            }
        }         
    )



</script>

</body>
</html>