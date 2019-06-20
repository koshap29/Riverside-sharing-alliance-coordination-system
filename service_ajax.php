<?php
require_once "db.php";
//print_r($_POST); exit;
if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `service` WHERE `Id` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];

  $name         = $_POST['name'];
  $hours      = $_POST['hours'];
  $conditions  = $_POST['conditions'];
  
  $date = date("Y-m-d");

  if($id > 0){
   $query = "UPDATE `service` SET `name` = '".$name."', `hours` = '".$hours."', `conditions` = '".$conditions."',
`updatedAt` = '".$date."' WHERE Id = ".$id;
      $result = $mysqli->query($query);
  } else {
  $query = "INSERT INTO `service` (`name`, `hours`, `conditions`, `createdAt`, `updatedAt`) VALUES ('".$name."',
'".$hours."', '".$conditions."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM service ORDER BY `Id` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";
//print_r($data); exit;
foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='service_add.php?id=".$value['Id']."'>".$value['name']."</a></td>";
  $string .= "<td class='text-left'>".$value['hours']."</td>";
  $string .= "<td class='text-left'>".$value['conditions']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['Id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>