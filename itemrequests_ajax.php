<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `itemrequests` WHERE `itemId` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $category      = $_POST['category'];
  $userId     = $_POST['userId'];
  $siteId     = $_POST['siteId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `itemrequests` SET `category` = '".$category."', `siteId` = '".$siteId."', `userId` = '".$userId."', `updatedAt` = '".$date."' WHERE itemId = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `itemrequests` (`category`, `siteId`, `userId`, `createdAt`, `updatedAt`) VALUES ('".$category."', '".$siteId."', '".$userId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT * FROM `itemrequests` ir, `site` s, `user` u WHERE ir.`siteId` = s.`Id` AND ir.`userId` = u.`userId` ORDER BY `itemId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='itemrequests_add.php?id=".$value['itemId']."'>".$value['category']."</a></td>";
  $string .= "<td class='text-left'>".$value['Name']."</td>";
  $string .= "<td class='text-left'>".$value['userName']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['itemId']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>