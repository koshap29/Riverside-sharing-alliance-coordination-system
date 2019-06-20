<?php require_once "db.php";?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Items</title>
		<link rel="stylesheet" media="screen" href="style.css">
	</head>
	<body class="fullpage logged-out" cz-shortcut-listen="true">
		<?php include_once "header.php";?>
		<div id="result-iframe-wrap" role="main">
			<div class="table-title">
				<h3 style="float: left;">Items Listing Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="items
						.php">Listing</a>
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `items` WHERE itemId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="Id" id="id" value="<?php echo $data['itemId']?>">
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
						<th class="text-left">Number of Unit*</th>
						<td class="text-left">
							<div class="error" id="number_of_unit_error">Please enter number_of_unit</div>
							<input type="text" id="number_of_unit" name="number_of_unit"  size="70" value="<?php echo
                            empty($data['number_of_unit']) ? "" : $data['number_of_unit'];?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Expiry Date *</th>
						<td class="text-left">
							<div class="error" id="expiryDate_error">Please enter expiryDate</div>
							<input type="text" id="expiryDate" name="expiryDate"  size="70" placeholder="YYYY-MM-DD" value="<?php echo empty($data['expiryDate']) ? "" : $data['expiryDate'];?>">
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $( function() {
        $( "#expiryDate" ).datepicker();
    } );
	$(document).on('keyup','#name',function(){
		name = $("#name").val();

		if(name.length > 0){
    		$("#name_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#number_of_unit',function(){
        number_of_unit = $("#number_of_unit").val();

		if(number_of_unit.length > 0){
    		$("#number_of_unit_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#expiryDate',function(){
        expiryDate = $("#expiryDate").val();

		if(expiryDate.length > 0){
    		$("#expiryDate_error").hide();
    		return true;
    	}
	});

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	name = $("#name").val();
        number_of_unit = $("#number_of_unit").val();
        expiryDate = $("#expiryDate").val();

    	if(name.length == 0){
    		$("#name_error").show();
    		return false;
    	}

    	if(number_of_unit.length == 0){
    		$("#number_of_unit_error").show();
    		return false;
    	}

    	if(expiryDate.length == 0){
    		$("#expiryDate_error").show();
    		return false;
    	}

    	$.ajax({
            url: "items_ajax.php",
            type: "POST",
            data:  {id:id, name:name,number_of_unit:number_of_unit,expiryDate:expiryDate,action:'add_edit'},
            success: function(response) {
                if(response == true){
                	window.location.href = 'item.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>