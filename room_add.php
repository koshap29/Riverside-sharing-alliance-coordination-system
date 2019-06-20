<?php require_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Room</title>
		<link rel="stylesheet" media="screen" href="style.css">
	</head>
	<body class="fullpage logged-out" cz-shortcut-listen="true">
		<?php include_once "header.php";?>
		<div id="result-iframe-wrap" role="main">
			<div class="table-title">
				<h3 style="float: left;">Room Listing Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="room
						.php">Listing</a>
					</div>
				</div>
			</div>
			<?php
            $shelter = "SELECT * FROM `shelter` ";
            $shelter_result = $mysqli->query($shelter);

            while ($row = $shelter_result->fetch_array(MYSQLI_ASSOC)) {
                $shelter_data[] = $row;
            }

			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `room` WHERE roomId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="Id" id="id" value="<?php echo $data['roomId']?>">
			<table class="table-fill">
				<tbody>
					<tr>
						<th class="text-left">Shelter Name *</th>
						<td class="text-left">
							<div class="error" id="shelterId_error">Please Select shelter</div>
							<select name="shelterId" id="shelterId" style="width: 580px; height: 30px;">
                                <option value="">Select Shelter</option>
                                <?php foreach ($shelter_data as $key => $value) { ?>
                                <option value="<?php echo $value['shelterId']?>" <?php if($value['shelterId'] == $data['shelterId']) { ?> selected <?php } ?>><?php echo $value['name']?></option>
                                <?php } ?>
                            </select>
						</td>
					</tr>
					<tr>
						<th class="text-left">Available Room*</th>
						<td class="text-left">
							<div class="error" id="availableroom_error">Please enter availableroom</div>
							<input type="text" id="availableroom" name="availableroom"  size="70" value="<?php echo
                            empty($data['availableroom']) ? "" : $data['availableroom'];?>">
						</td>
					</tr>
					<tr>
                        <th class="text-left"></th>
                        <td class="text-left">
                            <div class="error" id="form_error">Internal error</div>
                            <a href="#" class="submit"><img src="submit.png" width="100" height="50" /></a>
                        </td>
                    </tr>
				</tbody>
			</table>
		</div>
	</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
	$(document).on('keyup','#shelterId',function(){
        shelterId = $("#shelterId").val();

		if(shelterId.length > 0){
    		$("#shelterId_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#availableroom',function(){
        availableroom = $("#availableroom").val();

		if(availableroom.length > 0){
    		$("#availableroom_error").hide();
    		return true;
    	}
	});

	$(document).on('click','.submit',function(){
    	id = $("#id").val();

        shelterId = $("#shelterId").val();
        availableroom = $("#availableroom").val();

    	if(shelterId.length == 0){
    		$("#shelterId_error").show();
    		return false;
    	}

    	if(availableroom.length == 0){
    		$("#availableroom_error").show();
    		return false;
    	}

    	$.ajax({
            url: "room_ajax.php",
            type: "POST",
            data:  {id:id, shelterId:shelterId,availableroom:availableroom,action:'add_edit'},
            success: function(response) {
                if(response == true){
                	window.location.href = 'room.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>