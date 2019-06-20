<?php require_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Soup Kitchen</title>
		<link rel="stylesheet" media="screen" href="style.css">
	</head>
	<body class="fullpage logged-out" cz-shortcut-listen="true">
		<?php include_once "header.php";?>
		<div id="result-iframe-wrap" role="main">
			<div class="table-title">
				<h3 style="float: left;">Shoup Kitchen Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="soupkitchen.php">Listing</a>
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `soupkitchen` WHERE kitchenId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="id" id="id" value="<?php echo $data['kitchenId']?>">
			<table class="table-fill">
				<tbody>
					<tr>
						<th class="text-left">Total Seats *</th>
						<td class="text-left">
							<div class="error" id="totalSeats_error">Please enter Total Seats</div>
							<input type="text" id="totalSeats" name="totalSeats" size="70" value="<?php echo $data['totalSeats']?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Location *</th>
						<td class="text-left">
							<div class="error" id="locations_error">Please enter location</div>
							<input type="text" id="locations" name="locations"  size="70" value="<?php echo
                            $data['locations']?>">
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


	$(document).on('keyup','#totalSeats',function(){
        totalSeats = $("#totalSeats").val();

		if(totalSeats.length > 0){
    		$("#totalSeats_error").hide();
    		return true;
    	}
	});

    $(document).on('keyup','#locations',function(){
        locations = $("#locations").val();

        if(locations.length > 0){
            $("#locations_error").hide();
            return true;
        }
    });

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

        totalSeats = $("#totalSeats").val();
        locations = $("#locations").val();

    	if(totalSeats.length == 0){
    		$("#totalSeats_error").show();
    		return false;
    	}

    	if(locations.length == 0){
    		$("#locations_error").show();
    		return false;
    	}

    	$.ajax({
            url: "soupkitchen_ajax.php",
            type: "POST",
            data:  {id:id, totalSeats:totalSeats,locations:locations,action:'add_edit'},
            success: function(response) {
                if(response == true){
                	window.location.href = 'soupkitchen.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>