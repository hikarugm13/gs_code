<?php
$rating = $_POST['rating'];
$reviewer = $_POST['reviewer'];
$review = $_POST['review'];
$stadium = $_POST['stadium'];
var_dump($_POST);
//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_kadai_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBconnectError:'.$e->getMessage());
}

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_stadium_table( id,reviewer,stadiumName,rating,review,indate )VALUES(NULL,:a1,:a2,:a3,:a4,sysdate())");
$stmt->bindValue(':a1', $reviewer, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $stadium, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $rating, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $review, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
header('Location:kadaiindex.php');

}

?>

