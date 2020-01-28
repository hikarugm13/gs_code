<?php
$id   = $_POST["id"];
$rating = $_POST['rating'];
// $reviewer = $_POST['reviewer'];
$review = $_POST['review'];
// $stadium = $_POST['stadium'];
//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  include("funcs.php");
  $pdo = new PDO('mysql:dbname=gs_kadai_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DBconnectError:'.$e->getMessage());
}
//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//基本的にinsert.phpの処理の流れと同じです。
$stmt = $pdo->prepare("UPDATE gs_stadium_table SET review= :review,rating= :rating WHERE id = :id");
// $stmt->bindValue(':reviewer', $reviewer, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
// $stmt->bindValue(':stadium', $stadium, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':rating', $rating, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':review', $review, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 

$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("kadaiIndex.php");
}

?>
