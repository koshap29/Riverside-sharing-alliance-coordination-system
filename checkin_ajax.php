<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `checkin` WHERE `checkinId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $userId     = $_POST['userId'];
  $clientId      = $_POST['clientId'];
  $siteId     = $_POST['siteId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `checkin` SET `userId` = '".$userId."', `clientId` = '".$clientId."', `siteId` = '".$siteId."', `updatedAt` = '".$date."' WHERE checkinId = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `checkin` (`userId`, `clientId`, `siteId`, `createdAt`, `updatedAt`) VALUES ('".$userId."', '".$clientId."', '".$siteId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT *,cl.`Name` as cl_name,s.`Name` as s_name  FROM `checkin` c, `user` u, `client` cl, `site` s WHERE c.`userId` = u.`userId` AND c.`clientId` = cl.`shelterId` AND c.`siteId` = s.`Id` ORDER BY `checkinId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='checkin_add.php?id=".$value['checkinId']."'>".$value['userName']."</a></td>";
  $string .= "<td class='text-left'>".$value['cl_name']."</td>";
  $string .= "<td class='text-left'>".$value['s_name']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['checkinId']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>