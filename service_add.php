<?php require_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Service</title>
		<link rel="stylesheet" media="screen" href="style.css">
	</head>
	<body class="fullpage logged-out" cz-shortcut-listen="true">
		<?php include_once "header.php";?>
		<div id="result-iframe-wrap" role="main">
			<div class="table-title">
				<h3 style="float: left;">Service Listing Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="service
						.php">Listing</a>
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `service` WHERE Id = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="Id" id="id" value="<?php echo $data['Id']?>">
			<table class="table-fill">
				<tbody>
					<tr>
						<th class="text-left">Name *</th>
						<td class="text-left">
							<div class="error" id="name_error">Please enter name</div>
							<input type="text" id="name" name="name" size="70" value="<?php echo empty($data['name'])
                                ? "" : $data['name'];?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">hours*</th>
						<td class="text-left">
							<div class="error" id="hours_error">Please enter hours</div>
							<input type="text" id="hours" name="hours"  size="70" value="<?php echo
                            empty($data['hours']) ? "" : $data['hours'];?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Conditions *</th>
						<td class="text-left">
							<div class="error" id="conditions_error">Please enter Conditions</div>
							<input type="text" id="conditions" name="conditions"  size="70" value="<?php echo empty($data['conditions']) ? "" : $data['conditions'];?>">
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

	$(document).on('keyup','#hours',function(){
        hours = $("#hours").val();

		if(hours.length > 0){
    		$("#hours_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#conditions',function(){
        conditions = $("#conditions").val();

		if(conditions.length > 0){
    		$("#conditions_error").hide();
    		return true;
    	}
	});

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	name = $("#name").val();
    	hours = $("#hours").val();
        conditions = $("#conditions").val();

    	if(name.length == 0){
    		$("#name_error").show();
    		return false;
    	}

    	if(hours.length == 0){
    		$("#hours_error").show();
    		return false;
    	}

    	if(conditions.length == 0){
    		$("#conditions_error").show();
    		return false;
    	}

    	$.ajax({
            url: "service_ajax.php",
            type: "POST",
            data:  {id:id, name:name,hours:hours,conditions:conditions,action:'add_edit'},
            success: function(response) {
                if(response == true){
                	window.location.href = 'service.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>