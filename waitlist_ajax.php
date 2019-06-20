<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `waitlist` WHERE `userId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $name       = $_POST['name'];
  $roomId     = $_POST['roomId'];
  $clientId   = $_POST['clientId'];
  $userId     = $_POST['userId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `waitlist` SET `name` = '".$name."', `roomId` = '".$roomId."', `clientId` = '".$clientId."', `userId` = '".$userId."', `updatedAt` = '".$date."' WHERE Id = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `waitlist` (`name`, `roomId`, `clientId`, `userId`, `createdAt`, `updatedAt`) VALUES ('".$name."', '".$roomId."', '".$clientId."', '".$userId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT *, w.`Id` as w_id, w.`name` as w_name , s.name as s_name, c.`Name` as c_name FROM `waitlist` w, `room` r, `shelter` s, `client` c , `user` u WHERE w.`roomId` = r.`roomId` AND r.`shelterId` = s.`shelterId` AND w.`clientId` = c.`Id` AND w.`userId` = u.`userId` ORDER BY w.`Id` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='waitlist_add.php?id=".$value['w_id']."'>".$value['w_name']."</a></td>";
  $string .= "<td class='text-left'>".$value['s_name']."</td>";
  $string .= "<td class='text-left'>".$value['c_name']."</td>";
  $string .= "<td class='text-left'>".$value['userName']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['w_id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>