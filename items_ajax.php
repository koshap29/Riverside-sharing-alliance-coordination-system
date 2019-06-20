<?php
require_once "db.php";
//print_r($_POST); exit;
if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `items` WHERE `itemId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];

  $name         = $_POST['name'];
  $expiryDate      = date("Y-m-d", strtotime($_POST['expiryDate']));
  $number_of_unit = $_POST['number_of_unit'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `items` SET `name` = '".$name."', `expiryDate` = '".$expiryDate."', `number_of_unit` = '".$number_of_unit."',
`updatedAt` = '".$date."' WHERE itemId = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `items` (`name`, `expiryDate`, `number_of_unit`, `createdAt`, `updatedAt`) VALUES ('".$name."',
'".$expiryDate."', '".$number_of_unit."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM items ORDER BY `itemId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";
//print_r($data); exit;
foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='item_add.php?id=".$value['itemId']."'>".$value['name']."</a></td>";
  $string .= "<td class='text-left'>".$value['number_of_unit']."</td>";
  $string .= "<td class='text-left'>".$value['expiryDate']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['itemId']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>