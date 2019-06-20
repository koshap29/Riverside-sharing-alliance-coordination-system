<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `foodbank` WHERE `foodbankId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id     = $_POST['id'];

  $foodbankId     = $_POST['foodbankId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `foodbank` SET `foodbankId` = '".$foodbankId."', `updatedAt` = '".$date."' WHERE foodbankId = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `foodbank` (`foodbankId`, `createdAt`, `updatedAt`) VALUES ('".$foodbankId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM `foodbank` ORDER BY `foodbankId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='foodbank_add.php?id=".$value['foodbankId']."'>".$value['foodbankId']."</a></td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['foodbankId']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>