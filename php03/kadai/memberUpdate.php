<?php
//1.POSTでParamを取得
$id   = $_POST["id"];
$name   = $_POST["name"];
$lid   = $_POST["lid"];
$lpw   = $_POST["lpw"];

//2.DB接続など
include("funcs.php");
$pdo = db_conn();
//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//基本的にinsert.phpの処理の流れと同じです。
$stmt = $pdo->prepare("UPDATE gs_user_table SET name=:name,lid=:lid,lpw = :lpw WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  sql_error();
}else{
  redirect("allMembers.php");
}

?>
