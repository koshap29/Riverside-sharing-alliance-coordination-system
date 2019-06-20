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
				<h3 style="float: left;">Shelter Listing Add</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="shelter
						.php">Listing</a>
					</div>
				</div>
			</div>
			<?php
			if(isset($_GET) && !empty($_GET)){
				$id = $_GET['id'];
				$query = "SELECT * FROM `shelter` WHERE shelterId = ".$id;
				$result = $mysqli->query($query);

				$data = $result->fetch_array(MYSQLI_ASSOC);
			} else {
				$data = array();
			}
			?>
			<input type="hidden" name="Id" id="id" value="<?php echo $data['shelterId']?>">
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
						<th class="text-left">Number of Female*</th>
						<td class="text-left">
							<div class="error" id="number_of_female_error">Please enter Number of female</div>
							<input type="text" id="number_of_female" name="number_of_female"  size="70" value="<?php echo
                            empty($data['number_of_female']) ? "" : $data['number_of_female'];?>">
						</td>
					</tr>
					<tr>
						<th class="text-left">Number of Male *</th>
						<td class="text-left">
							<div class="error" id="number_of_male_error">Please enter number of male</div>
							<input type="text" id="number_of_male" name="number_of_male"  size="70" value="<?php echo empty($data['number_of_male']) ? "" : $data['number_of_male'];?>">
						</td>
					</tr>
                    <tr>
                        <th class="text-left">Number of Mixed *</th>
                        <td class="text-left">
                            <div class="error" id="number_of_mixed_error">Please enter number of mixed</div>
                            <input type="text" id="number_of_mixed" name="number_of_mixed"  size="70" value="<?php echo empty($data['number_of_mixed']) ? "" : $data['number_of_mixed'];?>">
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

	$(document).on('keyup','#number_of_female',function(){
        number_of_female = $("#number_of_female").val();

		if(number_of_female.length > 0){
    		$("#number_of_female_error").hide();
    		return true;
    	}
	});

	$(document).on('keyup','#number_of_male',function(){
        number_of_male = $("#number_of_male").val();

		if(number_of_male.length > 0){
    		$("#number_of_male_error").hide();
    		return true;
    	}
	});
    $(document).on('keyup','#number_of_mixed',function(){
        number_of_male = $("#number_of_mixed").val();

        if(number_of_mixed.length > 0){
            $("#number_of_mixed_error").hide();
            return true;
        }
    });

    $(document).on('click','.submit',function(){
    	id = $("#id").val();

    	name = $("#name").val();
    	number_of_female = $("#number_of_female").val();
        number_of_male = $("#number_of_male").val();
        number_of_mixed = $("#number_of_mixed").val();

    	if(name.length == 0){
    		$("#name_error").show();
    		return false;
    	}

    	if(number_of_female.length == 0){
    		$("#number_of_female_error").show();
    		return false;
    	}

    	if(number_of_male.length == 0){
    		$("#number_of_male_error").show();
    		return false;
    	}

        if(number_of_mixed.length == 0){
            $("#number_of_mixed_error").show();
            return false;
        }

    	$.ajax({
            url: "shelter_ajax.php",
            type: "POST",
            data:  {id:id, name:name,number_of_female:number_of_female,number_of_male:number_of_male,number_of_mixed:number_of_mixed,action:'add_edit'},
            success: function(response) {
                if(response == true){
                	window.location.href = 'shelter.php';
                } else {
                	$("#form_error").show();
    				return false;
                }
            }
        });
	});
</script>