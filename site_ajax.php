<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `site` WHERE `id` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $name         = $_POST['name'];
  $address      = $_POST['address'];
  $city         = $_POST['city'];
  $zipcode      = $_POST['zipcode'];
  $phoneNumber  = $_POST['phoneNumber'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `site` SET `Name` = '".$name."', `address` = '".$address."', `city` = '".$city."', `zipcode` = '".$zipcode."', `phoneNumber` = '".$phoneNumber."', `updatedAt` = '".$date."' WHERE Id = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `site` (`Name`, `address`, `city`, `zipcode`, `phoneNumber`, `createdAt`, `updatedAt`) VALUES ('".$name."', '".$address."', '".$city."', '".$zipcode."', '".$phoneNumber."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM site ORDER BY `id` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='site_add.php?id=".$value['Id']."'>".$value['Name']."</a></td>";
  $string .= "<td class='text-left'>".$value['address']."</td>";
  $string .= "<td class='text-left'>".$value['city']."</td>";
  $string .= "<td class='text-left'>".$value['zipcode']."</td>";
  $string .= "<td class='text-left'>".$value['phoneNumber']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['Id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>