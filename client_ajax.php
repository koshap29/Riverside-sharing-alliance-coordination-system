<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `client` WHERE `Id` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $name         = $_POST['name'];
  $waitlistId      = $_POST['waitlistId'];
  $phoneNumber  = $_POST['phoneNumber'];
  $shelterId  = $_POST['shelterId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `client` SET `Name` = '".$name."', `waitlistId` = '".$waitlistId."', `phoneNumber` = '".$phoneNumber."', `shelterId` = '".$shelterId."', `updatedAt` = '".$date."' WHERE Id = ".$id;
      $result = $mysqli->query($query);
  } else {
  $query = "INSERT INTO `client` (`Name`, `waitlistId`, `phoneNumber`, `shelterId`, `createdAt`, `updatedAt`) VALUES ('".$name."', '".$waitlistId."', '".$phoneNumber."', '".$shelterId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT *, w.`name` as w_name, s.`name` as s_name FROM `client` c , `waitlist` w, `shelter` s WHERE c.`waitlistId` = w.`Id` AND c.`shelterId` = s.`shelterId` ORDER BY c.`Id` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='client_add.php?id=".$value['Id']."'>".$value['Name']."</a></td>";
  $string .= "<td class='text-left'>".$value['w_name']."</td>";
  $string .= "<td class='text-left'>".$value['phoneNumber']."</td>";
  $string .= "<td class='text-left'>".$value['s_name']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['Id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>