<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `user` WHERE `userId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $userName     = $_POST['userName'];
  $emailId      = $_POST['emailId'];
  $password     = $_POST['password'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `user` SET `userName` = '".$userName."', `emailId` = '".$emailId."', `password` = '".$password."' , `updatedAt` = '".$date."' WHERE userId = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `user` (`userName`, `emailId`, `password`, `createdAt`, `updatedAt`) VALUES ('".$userName."', '".$emailId."', '".$password."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM user ORDER BY `userId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='user_add.php?id=".$value['userId']."'>".$value['userName']."</a></td>";
  $string .= "<td class='text-left'>".$value['emailId']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['userId']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>