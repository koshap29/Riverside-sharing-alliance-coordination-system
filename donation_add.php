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
				<h3 style="float: left;">Donation Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="donation.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `donation` WHERE donationId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['donationId']?>">
			<table class="table-fill">
				<tbody>
					<?php
					$query_foodbank = "SELECT * FROM `foodbank`";
					$result_foodbank = $mysqli->query($query_foodbank);

					$data_foodbank = array();

					while ($row = $result_foodbank->fetch_array(MYSQLI_ASSOC)) {
						$data_foodbank[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Food Bank ID *</th>
						<td class="text-left">
							<select id="foodbankId" name="foodbankId" style="width: 580px; height: 30px;">
								<?php foreach($data_foodbank as $value){?>
									<option value="<?php echo $value['foodbankId'];?>" <?php echo ($value['foodbankId'] == $data['foodbankId']) ? 'selected' : ''?>>
										<?php echo $value['foodbankId'];?>
									</option>
								<?php }?>
							</select>
						</td>
					</tr>
					<?php
					$query_items = "SELECT * FROM `items`";
					$result_items = $mysqli->query($query_items);

					$data_items = array();

					while ($row = $result_items->fetch_array(MYSQLI_ASSOC)) {
						$data_items[] = $row;
					}
					?>
					<tr>
						<th class="text-left">Food Pantry ID *</th>
						<td class="text-left">
							<select id="itemId" name="itemId" style="width: 580px; height: 30px;">
								<?php foreach($data_items as $value){?>
									<option value="<?php echo $value['itemId'];?>" <?php echo ($value['itemId'] == $data['itemId']) ? 'selected' : ''?>>
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
    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	foodbankId 	= $("#foodbankId").val();
    	itemId 	= $("#itemId").val();

    	$.ajax({
            url: "donation_ajax.php",
            type: "POST",
            data:  {id:id, foodbankId:foodbankId, itemId:itemId, action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'donation.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>