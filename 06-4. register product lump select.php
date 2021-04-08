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
<div class="register">
  <h1>商品一括登録</h1>
  <h2>"CSV"フォルダから選択してください</h2>
  <form action="06-5. register product lump confirm.php" method="post">
  <div class="btn-wrapper">
    <input id="file" name="file" type="file" />
  </div>
    <ul>
    <li id="name" style="margin-top:20px; font-size:20px;"></li>
    <!-- <li>■ type ：ファイルのMIMEタイプ：<span id="type"></span></li>
    <li>■ size ：ファイルサイズ ：<span id="size"></span></li> -->
    <!-- <li><span id="daytime"></span></li> -->
    </ul>
    <div class="btn-wrapper" id="confirm_btn"></div>
  </form>
</div>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>
<script>
window.addEventListener('DOMContentLoaded', function() {
// 指定されると動くメッソド
document.querySelector("#file").addEventListener('change', function(e) {
// ブラウザーがFile APIを利用できるか確認
if (window.File) {
// 指定したファイルの情報を取得
var input = document.querySelector('#file').files[0];
// 最後に、反映
document.querySelector('#name').innerHTML = `<input type="hidden" name="name" value="${input.name}">${input.name}`;
document.querySelector('#confirm_btn').innerHTML = `<input type="submit" value="登録内容を確認" id="submit" class="btn regBtn">`;
// document.querySelector('#type').innerHTML = input.type;
// document.querySelector('#size').innerHTML = input.size / 1024;
document.querySelector('#daytime').innerHTML = input.lastModifiedDate　;
}
}, true);
});
</script>

</body>
</html>