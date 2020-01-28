<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_kadai_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBconnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$sql1 = "SELECT stadiumName,ROUND(AVG(rating),2) FROM gs_stadium_table GROUP BY stadiumName ORDER BY AVG(rating) DESC";
$stmt1 = $pdo->prepare($sql1);
$status1 = $stmt1->execute();

//３．データ表示
$view="";
if($status1==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt1->errorInfo();
  exit("QUERYERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt1->fetch(PDO::FETCH_ASSOC)){
    $view .= "<tr>"."<td>".$result["stadiumName"]."</td>";
    $view.="<td>".$result["ROUND(AVG(rating),2)"]."</td>"."</tr>";
  }
}

//２.2．データ登録SQL作成
$sql2 = "SELECT stadiumName,COUNT(rating) FROM gs_stadium_table GROUP BY stadiumName ORDER BY COUNT(rating)  DESC";
$stmt2 = $pdo->prepare($sql2);
$status2 = $stmt2->execute();

//３.2データ表示
$view2="";
if($status2==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt2->errorInfo();
  exit("QUERYERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt2->fetch(PDO::FETCH_ASSOC)){
    $view2 .= "<tr>"."<td>".$result["stadiumName"]."</td>";
    $view2.="<td>".$result["COUNT(rating)"]."</td>"."</tr>";
  }
}
?>
<script>
// 結果をDBから表示
// console.log(data);
</script>
   <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧</title>
<link rel="stylesheet" href="style.css">
<!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>

</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<body>
  <div class="wrapper">
<table  id='stadiumRanking'>
  <h1 class='ranking1'>人気スタジアムランキング！！</h1>
  <a class='return' href="kadaiindex.php">戻る</a>
<tr>
    <th>スタジアム名</th>
    <th>平均評価</th>
    </tr>
    <div class="table"><?=$view?></div>
</table>
<table id ='reviewRanking'>
  <h1 class='ranking2'>口コミ数ランキング！！</h1>
<tr>
    <th>スタジアム名</th>
    <th>口コミ数</th>
    </tr>
    <div class="table"><?=$view2?></div>
</table>
</div>
</body>
<!-- Main[End] -->

</body>
</html>
