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
				<h3 style="float: left;">Item Requests Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="itemrequests.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `itemrequests` WHERE itemId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['itemId']?>">
			<table class="table-fill">
				<tbody>
					<tr>
						<th class="text-left">Category *</th>
						<td class="text-left">
							<input type="text" id="category" name="category" size="70" value="<?php echo $data['category']?>">
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
    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	category 	= $("#category").val();
    	userId 		= $("#userId").val();
    	siteId 		= $("#siteId").val();

    	$.ajax({
            url: "itemrequests_ajax.php",
            type: "POST",
            data:  {id:id, category:category, userId:userId, siteId:siteId, action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'itemrequests.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>