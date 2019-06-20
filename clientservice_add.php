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
				<h3 style="float: left;">Client Service Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="clientservice.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `clientservices` WHERE id = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['Id']?>">
			<table class="table-fill">
				<tbody>
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
					<?php
					$query_soupkitchen = "SELECT * FROM `soupkitchen`";
					$result_soupkitchen = $mysqli->query($query_soupkitchen);

					$data_soupkitchen = array();

					while ($row = $result_soupkitchen->fetch_array(MYSQLI_ASSOC)) {
						$data_soupkitchen[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Kitchen ID *</th>
						<td class="text-left">
							<select id="kitchenId" name="kitchenId" style="width: 580px; height: 30px;">
								<?php foreach($data_soupkitchen as $value){?>
									<option value="<?php echo $value['kitchenId'];?>" <?php echo ($value['kitchenId'] == $data['kitchenId']) ? 'selected' : ''?>>
										<?php echo $value['totalSeats'];?>
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
					<?php
					$query_foodpantry = "SELECT * FROM `foodpantry`";
					$result_foodpantry = $mysqli->query($query_foodpantry);

					$data_foodpantry = array();

					while ($row = $result_foodpantry->fetch_array(MYSQLI_ASSOC)) {
						$data_foodpantry[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Food Pantry ID *</th>
						<td class="text-left">
							<select id="foodpantryId" name="foodpantryId" style="width: 580px; height: 30px;">
								<?php foreach($data_foodpantry as $value){?>
									<option value="<?php echo $value['Id'];?>" <?php echo ($value['Id'] == $data['foodpantryId']) ? 'selected' : ''?>>
										<?php echo $value['SSN'];?>
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

    	shelterId 		= $("#shelterId").val();
    	kitchenId 		= $("#kitchenId").val();
    	siteId 			= $("#siteId").val();
    	foodpantryId 	= $("#foodpantryId").val();

    	$.ajax({
            url: "clientservice_ajax.php",
            type: "POST",
            data:  {id:id, shelterId:shelterId, kitchenId:kitchenId, siteId:siteId, foodpantryId:foodpantryId, action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'clientservice.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>