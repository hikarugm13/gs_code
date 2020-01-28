<?php

$id   = $_GET["id"];
include("funcs.php");
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_stadium_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

$row = $stmt->fetch();
var_dump($row);
//３．データ表示

//index.php（登録フォームの画面ソースコードを全コピーして、PHP処理以降のこのファイルをまるっと上書き保存）
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>コメント編集</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="kadaiIndex.php">ホーム</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="commentUpdate.php">
  <div class="jumbotron">
   <fieldset>
    <legend>コメント編集</legend>
    <div>スタジアム名：<?=$row["stadiumName"]?></div><br>
    <label>評価：
     <span class="star-rating" value="<?=$row["rating"]?>">
      <input type="radio" name="rating" type="number" value="1"><i></i>
      <input type="radio" name="rating" type="number" value="2"><i></i>
      <input type="radio" name="rating" type="number" value="3"><i></i>
      <input type="radio" name="rating" type="number" value="4"><i></i>
      <input type="radio" name="rating" type="number" value="5"><i></i>
    </span>
    </label><br>
     <textarea name="review" id="comment" cols="30" rows="10" ><?=$row["review"]?></textarea>
     <input type="hidden" name="id" value="<?=$row["id"]?>" >

     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
