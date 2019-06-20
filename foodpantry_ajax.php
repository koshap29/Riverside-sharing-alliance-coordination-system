<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `foodpantry` WHERE `Id` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id     = $_POST['id'];

  $SSN     = $_POST['SSN'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `foodpantry` SET `SSN` = '".$SSN."', `updatedAt` = '".$date."' WHERE Id = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `foodpantry` (`SSN`, `createdAt`, `updatedAt`) VALUES ('".$SSN."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM `foodpantry` ORDER BY `Id` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='foodpantry_add.php?id=".$value['Id']."'>".$value['SSN']."</a></td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['Id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>