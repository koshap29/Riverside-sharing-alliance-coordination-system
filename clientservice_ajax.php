<?php
require_once "db.php";

if(isset($_POST['action']) && $_POST['action'] == 'delete'){
  $id = $_POST['id'];

  $query = "DELETE FROM `clientservices` WHERE `id` = ".$id;
  $result = $mysqli->query($query);
}

if(isset($_POST['action']) && $_POST['action'] == 'add_edit'){
  $id         = $_POST['id'];
  
  $shelterId        = $_POST['shelterId'];
  $kitchenId        = $_POST['kitchenId'];
  $siteId           = $_POST['siteId'];
  $foodpantryId     = $_POST['foodpantryId'];
  
  $date = date("Y-m-d");

  if($id > 0){
    $query = "UPDATE `clientservices` SET `shelterId` = '".$shelterId."', `kitchenId` = '".$kitchenId."', `siteId` = '".$siteId."', `foodpantryId` = '".$foodpantryId."', `updatedAt` = '".$date."' WHERE id = ".$id;
      $result = $mysqli->query($query);
  } else {
    $query = "INSERT INTO `clientservices` (`shelterId`, `kitchenId`, `siteId`, `foodpantryId`, `createdAt`, `updatedAt`) VALUES ('".$shelterId."', '".$kitchenId."', '".$siteId."', '".$foodpantryId."', '".$date."', '".$date."')";
    $result = $mysqli->query($query);
  }

  if($result)
    echo true;
  else
    echo false;
  exit;
}

$query = "SELECT *, cs.`Id` as cs_id, s.`name` as s_name , st.`Name` as st_name, f.`SSN` as f_ssn FROM `clientservices` cs, `shelter` s, `site` st , `foodpantry` f WHERE cs.`shelterId` = s.`shelterId` AND cs.`siteId` = st.`Id` AND cs.`foodpantryId` = f.`Id` ORDER BY cs.`id` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  $data[] = $row;
}

$string = "";

foreach ($data as $key => $value) {
  $string .= "<tr>";
  $string .= "<td class='text-left'><a href='clientservice_add.php?id=".$value['cs_id']."'>".$value['s_name']."</a></td>";
  $string .= "<td class='text-left'>".$value['kitchenId']."</td>";
  $string .= "<td class='text-left'>".$value['st_name']."</td>";
  $string .= "<td class='text-left'>".$value['f_ssn']."</td>";
  $string .= "<td class='text-left'>".$value['createdAt']."</td>";
  $string .= "<td class='text-left'>".$value['updatedAt']."</td>";
  $string .= "<td class='text-left'><a href='#' data-id='".$value['cs_id']."' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
  $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>