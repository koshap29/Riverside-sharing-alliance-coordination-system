<?php require_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Site</title>
		<link rel="stylesheet" media="screen" href="style.css">
	</head>
	<body class="fullpage logged-out" cz-shortcut-listen="true">
		<?php include_once "header.php";?>
		<div id="result-iframe-wrap" role="main">
			<div class="table-title">
				<h3 style="float: left;">Waitlist Listing Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="site.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `waitlist` WHERE Id = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['Id']?>">
			<table class="table-fill">
				<tbody>
					<tr>
						<th class="text-left">Name *</th>
						<td class="text-left">
							<div class="error" id="name_error">Please enter name</div>
							<input type="text" id="name" name="name" size="70" value="<?php echo $data['name']?>">
						</td>
					</tr>
					<?php
					$query_room = "SELECT *, s.`name` as s_name FROM `room` r, `shelter` s WHERE r.`shelterId` = s.`shelterId`";
					$result_room = $mysqli->query($query_room);

					$data_room = array();

					while ($row = $result_room->fetch_array(MYSQLI_ASSOC)) {
						$data_room[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Room ID *</th>
						<td class="text-left">
							<select id="roomId" name="roomId" style="width: 580px; height: 30px;">
								<?php foreach($data_room as $value){?>
									<option value="<?php echo $value['roomId'];?>" <?php echo ($value['roomId'] == $data['roomId']) ? 'selected' : ''?>>
										<?php echo $value['s_name'];?>
									</option>
								<?php }?>
							</select>
						</td>
					</tr>
					<?php
					$query_client = "SELECT * FROM `client`";
					$result_client = $mysqli->query($query_client);

					$data_client = array();

					while ($row = $result_client->fetch_array(MYSQLI_ASSOC)) {
						$data_client[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Client ID *</th>
						<td class="text-left">
							<select id="clientId" name="clientId" style="width: 580px; height: 30px;">
								<?php foreach($data_client as $value){?>
									<option value="<?php echo $value['Id'];?>" <?php echo ($value['Id'] == $data['clientId']) ? 'selected' : ''?>>
										<?php echo $value['Name'];?>
									</option>
								<?php }?>
							</select>
						</td>
					</tr>
					<?php
					$query_user = "SELECT * FROM `user`";
					$result_user = $mysqli->query($query_user);

					$data_user = array();

					while ($row = $result_user->fetch_array(MYSQLI_ASSOC)) {
						$data_user[] = $row;
					}
					?>
					<tr>
						<th class="text-left">User ID *</th>
						<td class="text-left">
							<select id="userId" name="userId" style="width: 580px; height: 30px;">
								<?php foreach($data_user as $value){?>
									<option value="<?php echo $value['userId'];?>" <?php echo ($value['userId'] == $data['userId']) ? 'selected' : ''?>>
										<?php echo $value['userName'];?>
									</option>
								<?php }?>
							</select>
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
	$(document).on('keyup','#name',function(){
		name = $("#name").val();

		if(name.length > 0){
    		$("#name_error").hide();
    		return true;
    	}
	});

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	name = $("#name").val();
    	roomId = $("#roomId").val();
    	clientId = $("#clientId").val();
    	userId = $("#userId").val();

    	if(name.length == 0){
    		$("#name_error").show();
    		return false;
    	}

    	$.ajax({
            url: "waitlist_ajax.php",
            type: "POST",
            data:  {id:id, name:name, roomId:roomId, clientId:clientId, userId:userId, action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'waitlist.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>