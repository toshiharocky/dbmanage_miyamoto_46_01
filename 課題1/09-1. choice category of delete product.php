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
<h1>商品削除</h1>
<h2>カテゴリーを選択してください</h2>
<div class="choice-wrapper">
    <form class="options"action="09-2. choice delete product name.php" method="post">
        <button class="btn" type="submit" name="category" value="supplements">supplements</button><br>
        <button class="btn" type="submit" name="category" value="clothes">clothes</button><br>
        <button class="btn" type="submit" name="category" value="equipment">equipment</button><br>
        <button class="btn" type="submit" name="category" value="books">books</button>
    </form>
</div>
<div class="btn-wrapper">
    <button class="btn topBtn" onclick="location.href='index.html'">トップページへ戻る</button>
</div>

</body>
</html>