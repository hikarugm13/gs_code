<?php
require("config.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Select all the rows in the markers table
try{
  $sql = "select * from stadium_address_table where 1";
  $result = $pdo->query($sql);
  if($result->rowCount() > 0){
    header("Content-type: text/xml");
    // Start XML file, echo parent node
    echo "<?xml version='1.0' ?>";
    echo '<markers>';
    $ind=0;
    while($row = $result->fetch()){
      // Add to XML document node
      echo '<marker ';
      echo 'id="' . $row['id'] . '" ';
      echo 'name="' . parseToXML($row['name']) . '" ';
      echo 'address="' . parseToXML($row['address']) . '" ';
      echo 'lat="' . $row['lat'] . '" ';
      echo 'lng="' . $row['lng'] . '" ';
      echo 'type="' . $row['sportType'] . '" ';
      echo '/>';
      $ind = $ind + 1;
    }
    // End XML file
      echo '</markers>';
  }
}
catch(PDOException $e){
  die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
?>