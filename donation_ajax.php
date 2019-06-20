<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `donation` WHERE `donationId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $foodbankId        = $_POST['foodbankId'];
  $itemId        = $_POST['itemId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `donation` SET `foodbankId` = '".$foodbankId."', `itemId` = '".$itemId."', `updatedAt` = '".$date."' WHERE donationId = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `donation` (`foodbankId`, `itemId`, `createdAt`, `updatedAt`) VALUES ('".$foodbankId."', '".$itemId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT *, d.`donationId` as d_id, i.`name` as i_name FROM `donation` d, `foodbank` f, `items` i WHERE d.`foodbankId` = f.`foodbankId` AND d.`itemId` = i.`itemId` ORDER BY d.`donationId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='donation_add.php?id=".$value['d_id']."'>".$value['foodbankId']."</a></td>";
  $string .= "<td class='text-left'>".$value['i_name']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['d_id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>