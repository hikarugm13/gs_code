<?php
//1. GETでidを取得
$id   = $_GET["id"];

echo $id;
//2. DB接続します
include("funcs.php");
$pdo = db_conn();


//3. データ削除SQLを準備

$stmt = $pdo->prepare("DELETE  FROM gs_stadium_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)

//4. SQL実行
$status = $stmt->execute(); //実行

//5. 一覧ページへ戻す
if($status==false){
  sql_error($stmt);
}else{
  redirect("kadaiIndex.php");
}
?>