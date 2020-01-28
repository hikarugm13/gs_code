<?php
//1.POSTでParamを取得
$name   = $_POST["name"];
$lid   = $_POST["lid"];
$lpw   = $_POST["lpw"];

echo $name;
echo $lid;
echo $lpw;
//2.DB接続など
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(id,name,lid,lpw,kanri_flg,life_flg)VALUES(NULL,:name,:lid,:lpw,1,1)");
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
