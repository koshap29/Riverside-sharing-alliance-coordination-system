<?php
require_once "db.php";
//print_r($_POST); exit;
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $query = "DELETE FROM `shelter` WHERE `shelterId` = " . $id;
    $result = $mysqli->query($query);
}

if (isset($_POST['action']) && $_POST['action'] == 'add_edit') {
    $id = $_POST['id'];

    $name = $_POST['name'];
    $number_of_female = $_POST['number_of_female'];
    $number_of_male = $_POST['number_of_male'];
    $number_of_mixed = $_POST['number_of_mixed'];
    $date = date("Y-m-d");

    if ($id > 0) {
        $query = "UPDATE `shelter` SET `name` = '" . $name . "', `number_of_female` = '" . $number_of_female . "', `number_of_male` = '" . $number_of_male . "', number_of_mixed = '" .$number_of_mixed. "',
`updatedAt` = '" . $date . "' WHERE shelterId = " . $id;
        $result = $mysqli->query($query);
    } else {
        $query = "INSERT INTO `shelter` (`name`, `number_of_female`, `number_of_male`, `number_of_mixed`, `createdAt`, `updatedAt`)
VALUES ('" . $name . "','" . $number_of_female . "', '" . $number_of_male . "', '" . $number_of_mixed. "' ,'" . $date. "', '" . $date . "')";
        $result = $mysqli->query($query);
    }

    if ($result)
        echo true;
    else
        echo false;
    exit;
}

$query = "SELECT * FROM shelter ORDER BY `shelterId` DESC";
$result = $mysqli->query($query);

$data = array();

while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
    $data[] = $row;
}

$string = "";
//print_r($data); exit;
foreach ($data as $key => $value) {
    $string .= "<tr>";
    $string .= "<td class='text-left'><a href='shelter_add.php?id=" . $value['shelterId'] . "'>" . $value['name'] . "</a></td>";
    $string .= "<td class='text-left'>" . $value['number_of_female'] . "</td>";
    $string .= "<td class='text-left'>" . $value['number_of_male'] . "</td>";
    $string .= "<td class='text-left'>" . $value['number_of_mixed'] . "</td>";
    $string .= "<td class='text-left'>" . $value['createdAt'] . "</td>";
    $string .= "<td class='text-left'>" . $value['updatedAt'] . "</td>";
    $string .= "<td class='text-left'><a href='#' data-id='" . $value['shelterId'] . "' class='delete'><img src='delete.png' width='50px' height='50px'/></a></td>";
    $string .= "</tr>";
}

echo $string;

$result->free();
$mysqli->close();
?>