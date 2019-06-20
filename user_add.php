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
				<h3 style="float: left;">User Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="user.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `user` WHERE userId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['userId']?>">
			<table class="table-fill">
				<tbody>
					<tr>
						<th class="text-left">UserName *</th>
						<td class="text-left">
							<div class="error" id="userName_error">Please enter username</div>
							<input type="text" id="userName" name="userName" size="70" value="<?php echo $data['userName']?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Email ID *</th>
						<td class="text-left">
							<div class="error" id="emailId_error">Please enter email ID</div>
							<input type="text" id="emailId" name="emailId" size="70" value="<?php echo $data['emailId']?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Password *</th>
						<td class="text-left">
							<div class="error" id="password_error">Please enter password</div>
							<input type="text" id="password" name="password"  size="70" value="<?php echo $data['password']?>">
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
	$(document).on('keyup','#userName',function(){
		userName = $("#userName").val();

		if(userName.length > 0){
    		$("#userName_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#emailId',function(){
		emailId = $("#emailId").val();

		if(emailId.length > 0){
    		$("#emailId_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#password',function(){
		password = $("#password").val();

		if(password.length > 0){
    		$("#password_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#clientId',function(){
		clientId = $("#clientId").val();

		if(clientId.length > 0){
    		$("#clientId_error").hide();
    		return true;
    	}
	});

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	userName = $("#userName").val();
    	emailId = $("#emailId").val();
    	password = $("#password").val();

    	if(userName.length == 0){
    		$("#userName_error").show();
    		return false;
    	}

    	if(emailId.length == 0){
    		$("#emailId_error").show();
    		return false;
    	}

    	if(password.length == 0){
    		$("#password_error").show();
    		return false;
    	}

    	$.ajax({
            url: "user_ajax.php",
            type: "POST",
            data:  {id:id, userName:userName, emailId:emailId, password:password,action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'user.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>