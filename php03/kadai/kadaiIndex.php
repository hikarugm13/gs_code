
<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_kadai_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBconnectError:'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_stadium_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("QUERYERROR:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result[] = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    // .=で足していく感じ
    $json = json_encode($result);
  }
}
?>
<script>
// 結果をDBから表示
const data2 = JSON.parse('<?=$json?>');
</script>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>STADIUM REVIEW</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="wrapper">
    <h1 class="title">STUDIUM REVIEW3</h1>
    <div id="ranking"><a href='kadaiSelect.php'>ランキング</a></div>
    <div id="register"><a href='register.php'>会員登録</a></div>
      <div id="myMap"></div>

  <div class="kuchikomi" id='right'>
  <form action="kadaiInsert.php" method='post' id="form">
    <div id="stadiumName"></div>
    <p>Name<input type='text' id="reviewer" name="reviewer"></p>
    <span class="star-rating">
      <input type="radio" name="rating" type="number" value="1"><i></i>
      <input type="radio" name="rating" type="number" value="2"><i></i>
      <input type="radio" name="rating" type="number" value="3"><i></i>
      <input type="radio" name="rating" type="number" value="4"><i></i>
      <input type="radio" name="rating" type="number" value="5"><i></i>
    </span>
    <textarea name="review" id="comment" cols="30" rows="10" placeholder="このスタジアムの感想や体験を共有しましょう！"></textarea>
    <div id="btn"><input type="submit" value='送信'></div>
  </form>
  </div>
  <div class="result" id='right'>
  <div id="stadiumName2"></div>
  <div class="points">
    <div id='averageTitle'>AVERAGE:</div>
  <div id="average"></div>
  </div>

  <div id="reviews">

  </div>

  </div>

  </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/map.js"></script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=">
      </script>
</body>

</html>
