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
				<h3 style="float: left;">Checkin Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="checkin.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `checkin` WHERE checkinId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['userId']?>">
			<table class="table-fill">
				<tbody>
					<?php
					$query_user = "SELECT * FROM `user`";
					$result_user = $mysqli->query($query_user);

					$data_user = array();

					while ($row = $result_user->fetch_array(MYSQLI_ASSOC)) {
						$data_user[] = $row;
					}
					?>
					<tr>
						<th class="text-left">UserName *</th>
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
									<option value="<?php echo $value['shelterId'];?>" <?php echo ($value['shelterId'] == $data['clientId']) ? 'selected' : ''?>>
										<?php echo $value['Name'];?>
									</option>
								<?php }?>
							</select>
						</td>
					</tr>
					<?php
					$query_site = "SELECT * FROM `site`";
					$result_site = $mysqli->query($query_site);

					$data_site = array();

					while ($row = $result_site->fetch_array(MYSQLI_ASSOC)) {
						$data_site[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Site ID *</th>
						<td class="text-left">
							<select id="siteId" name="siteId" style="width: 580px; height: 30px;">
								<?php foreach($data_site as $value){?>
									<option value="<?php echo $value['Id'];?>" <?php echo ($value['Id'] == $data['siteId']) ? 'selected' : ''?>>
										<?php echo $value['Name'];?>
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
    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	userId 		= $("#userId").val();
    	clientId 	= $("#clientId").val();
    	siteId 		= $("#siteId").val();

    	$.ajax({
            url: "checkin_ajax.php",
            type: "POST",
            data:  {id:id, userId:userId, clientId:clientId, siteId:siteId,action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'checkin.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>