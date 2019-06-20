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
				<h3 style="float: left;">Client Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="client.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `client` WHERE Id = ".$id;
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
							<input type="text" id="name" name="name" size="70" value="<?php echo $data['Name']?>">
						</td>
					</tr>
					<?php
					$query_waitlist = "SELECT * FROM `waitlist`";
					$result_waitlist = $mysqli->query($query_waitlist);

					$data_waitlist = array();

					while ($row = $result_waitlist->fetch_array(MYSQLI_ASSOC)) {
						$data_waitlist[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Waitlist ID *</th>
						<td class="text-left">
							<select id="waitlistId" name="waitlistId" style="width: 580px; height: 30px;">
								<?php foreach($data_waitlist as $value){?>
									<option value="<?php echo $value['Id'];?>" <?php echo ($value['Id'] == $data['waitlistId']) ? 'selected' : ''?>>
										<?php echo $value['name'];?>
									</option>
								<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th class="text-left">Phone Number *</th>
						<td class="text-left">
							<div class="error" id="phoneNumber_error">Please enter phone number</div>
							<input type="text" id="phoneNumber" name="phoneNumber"  size="70" value="<?php echo $data['phoneNumber']?>">
						</td>
					</tr>
					<?php
					$query_shelter = "SELECT * FROM `shelter`";
					$result_shelter = $mysqli->query($query_shelter);

					$data_shelter = array();

					while ($row = $result_shelter->fetch_array(MYSQLI_ASSOC)) {
						$data_shelter[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Shelter ID *</th>
						<td class="text-left">
							<select id="shelterId" name="shelterId" style="width: 580px; height: 30px;">
								<?php foreach($data_shelter as $value){?>
									<option value="<?php echo $value['shelterId'];?>" <?php echo ($value['shelterId'] == $data['shelterId']) ? 'selected' : ''?>>
										<?php echo $value['name'];?>
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

	$(document).on('keyup','#phoneNumber',function(){
		phoneNumber = $("#phoneNumber").val();

		if(phoneNumber.length > 0){
    		$("#phoneNumber_error").hide();
    		return true;
    	}
	});

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	name = $("#name").val();
    	waitlistId = $("#waitlistId").val();
    	phoneNumber = $("#phoneNumber").val();
    	shelterId = $("#shelterId").val();

    	if(name.length == 0){
    		$("#name_error").show();
    		return false;
    	}

    	if(phoneNumber.length == 0){
    		$("#phoneNumber_error").show();
    		return false;
    	}

    	$.ajax({
            url: "client_ajax.php",
            type: "POST",
            data:  {id:id, name:name, waitlistId:waitlistId, phoneNumber:phoneNumber, shelterId:shelterId, action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'client.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>