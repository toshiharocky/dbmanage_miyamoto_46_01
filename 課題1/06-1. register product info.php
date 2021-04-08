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

?>
    <!-- 登録情報の記入 -->
    <form action="06-2. register confirm.php" method="post">
    <h1>商品情報登録</h1>
    <h2>商品情報を記入してください</h2>
    <div class="register">
        <table >
            <tr>
                <td class=register_table>カテゴリー：</td>
                <td class=register_table>
                    <select name="category" id="category">
                                <option value="default" selected>カテゴリーを選択</option>
                                <option value="supplements">001_supplements</option>
                                <option value="clothes">002_clothes</option>
                                <option value="equipment">003_equipment</option>
                                <option value="books">004_books</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class=register_table>商品番号*：</td>
                <td class=register_table>
                    <div class="productName" style="display:flex;">
                        <input type="text"name="category_num" id="category_num" style="width:50px; height:21px; border:solid 1px black;" readonly></input>
                        <p style="padding:0 15px; height=21px; line-height:21px">-</p> 
                        <input type="text" name="product_num" id="product_num" placeholder="6桁の数字を記入してください" style="width:200px">
                    </div>
                </td>
            </tr>
            <tr>
                <td class=register_table>商品名：</td>
                <td class=register_table><input class = "register_input" type="test" name="product_name" id='product_name'></td>
            </tr>
            <tr>
                <td class=register_table>在庫総数*：</td>
                <td class=register_table><input class = "register_input" type='text' name='total_amount' id='total_amount'></td>
            </tr>
            <tr>
                <td class=register_table>店舗内在庫*：</td>
                <td class=register_table><input class = "register_input" type='text' name='shop_amount' id='shop_amount'></td>
            </tr>
            <tr>
                <td class=register_table>倉庫内在庫*：</td>
                <td class=register_table><input class = "register_input" type='text' name='warehouse_amount' id='warehouse_amount'></td>
            </tr>
            <tr>
                <td class=register_table>納品待ち*：</td>
                <td class=register_table><input class = "register_input" type='text' name='waiting_amount' id='waiting_amount'></td>
            </tr>
            <tr>
                <td class=register_table>発注閾値*：</td>
                <td class=register_table><input class = "register_input" type="text" name="threshold" id="threshold"></td>
            </tr>
        </table>
        <input type="submit" value="送信" id="submit">
    </div>
    </form>
    <div class="btn-wrapper">
        <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
    </div>


<script>
    // <!-- カテゴリーを選択すると、カテゴリー番号が自動で入力される -->
    function category_num(a){
        // $("#category_num").empty();
        let b = ("000" + a).slice( -3 );
        $("#category_num").empty();
        $("#category_num").append(b);
        $('[name="category_num"]').val([b]);
    }

    $("#category").change(function(){
        let val =$(this).val();
        switch (val){
            case "supplements":
                category_num(001);
                // console.log(category_num.val())
                break;
            case "clothes":
                category_num(002);
                // console.log(category_num.val())                
                break;
            case "equipment":
                category_num(003);
                // console.log(category_num.val())                
                break;
            case "books":
                category_num(004);
                // console.log(category_num.val())                
                break;
        }
    })


    $("#submit").on("click", function(){
    // <!-- 登録ボタン押下時にカテゴリーが未選択の場合、「カテゴリーを選択してください」とアラートを出す -->
        if($("#category").val()=="default"){
            alert("カテゴリーを選択してください");
            return false;
        }
    // <!-- 登録ボタン押下時にどれか1つでも記入されていない場合は「全ての項目を記入してください」とアラートを出す -->
        else if($("#product_num").val()=="" || $("#product_name").val()=="" || $("#total_amount").val()=="" || $("#shop_amount").val()=="" || $("#warehouse_amount").val()=="" || $("#waiting_amount").val()=="" || $("#threshold").val()==""){
            alert("全ての項目を記入してください");
            return false;
        }
    // <!-- 登録ボタン押下時に商品番号と発注閾値に数字が入力されていない場合は、「商品番号と発注閾値には数字を入力してください」とアラートを出す -->
        else if(isNaN($("#product_num").val()) || isNaN($("#total_amount").val())  || isNaN($("#shop_amount").val())  || isNaN($("#warehouse_amount").val())  || isNaN($("#waiting_amount").val()) || isNaN($("#threshold").val())){
            console.log($("#product_num").val());
            console.log($("#threshold").val());
            alert("*印のある項目には数字を入力してください");
            return false;
        }
    // 商品番号が6桁でない場合は「商品番号は6桁の数字を記入してください」とアラートを出す
        else if($("#product_num").val().toString().length!=6){
            console.log($("#product_num").val().toString().length);
            alert("商品番号は6桁の数字を記入してください");
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