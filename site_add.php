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
				<h3 style="float: left;">Site Listing Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="site.php">Listing</a>	
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM site WHERE id = ".$id;
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
					<tr>
						<th class="text-left">Address *</th>
						<td class="text-left">
							<div class="error" id="address_error">Please enter address</div>
							<input type="text" id="address" name="address"  size="70" value="<?php echo $data['address']?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">City *</th>
						<td class="text-left">
							<div class="error" id="city_error">Please enter city</div>
							<input type="text" id="city" name="city"  size="70" value="<?php echo $data['city']?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Zipcode *</th>
						<td class="text-left">
							<div class="error" id="zipcode_error">Please enter zipcode</div>
							<input type="text" id="zipcode" name="zipcode"  size="70" value="<?php echo $data['zipcode']?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Phone Number *</th>
						<td class="text-left">
							<div class="error" id="phoneNumber_error">Please enter phone number</div>
							<input type="text" id="phoneNumber" name="phoneNumber"  size="70" value="<?php echo $data['phoneNumber']?>">
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

	$(document).on('keyup','#address',function(){
		address = $("#address").val();

		if(address.length > 0){
    		$("#address_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#city',function(){
		city = $("#city").val();

		if(city.length > 0){
    		$("#city_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#zipcode',function(){
		zipcode = $("#zipcode").val();

		if(zipcode.length > 0){
    		$("#zipcode_error").hide();
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
    	address = $("#address").val();
    	city = $("#city").val();
    	zipcode = $("#zipcode").val();
    	phoneNumber = $("#phoneNumber").val();

    	if(name.length == 0){
    		$("#name_error").show();
    		return false;
    	}

    	if(address.length == 0){
    		$("#address_error").show();
    		return false;
    	}

    	if(city.length == 0){
    		$("#city_error").show();
    		return false;
    	}

    	if(zipcode.length == 0){
    		$("#zipcode_error").show();
    		return false;
    	}

    	if(phoneNumber.length == 0){
    		$("#phoneNumber_error").show();
    		return false;
    	}

    	$.ajax({
            url: "site_ajax.php",
            type: "POST",
            data:  {id:id, name:name,address:address,city:city,zipcode:zipcode,phoneNumber:phoneNumber,action:'add_edit'}, 
            success: function(response) {
                if(response == true){
                	window.location.href = 'site.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>