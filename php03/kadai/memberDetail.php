<?php

$id   = $_GET["id"];
include("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

$row = $stmt->fetch();
//３．データ表示

//index.php（登録フォームの画面ソースコードを全コピーして、PHP処理以降のこのファイルをまるっと上書き保存）
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="allMembers.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="memberUpdate.php">
  <div class="jumbotron">
   <fieldset>
    <legend>会員情報編集</legend>
     <label>名前：<input type="text" value="<?=$row["name"]?>" name="name"></label><br>
     <label>ID：<input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>パスワード：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>" >
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
