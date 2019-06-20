<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Client</title>
		<link rel="stylesheet" media="screen" href="style.css">
	</head>
	<body class="fullpage logged-out" cz-shortcut-listen="true">
		<?php include_once "header.php";?>
		<div id="result-iframe-wrap" role="main">
			<div class="table-title">
				<h3 style="float: left;">User Listing</h3>
				<div class="header-chunk primary-actions secondary-nav">
					<div class="signup-and-login">
						<a id="login-button" class="button button-editor-solid login-button" href="user_add.php">Add</a>	
					</div>
				</div>
			</div>
			<table class="table-fill">
				<thead>
					<tr>
						<th class="text-left">UserName</th>
						<th class="text-left">Email ID</th>
						<th class="text-left">Created @</th>
						<th class="text-left">Updated @</th>
						<th class="text-left">Action</th>
					</tr>
				</thead>
				<tbody class="table-hover" id="table_record"></tbody>
			</table>
		</div>
	</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {

    	$("#table_record").html('<tr><td style="text-align:center" colspan="8"><img src="ajax-loader.gif" width="250px" height="auto"/></td></tr>');

    	setTimeout(function(){
            $.ajax({
	            url: "user_ajax.php",
	            type: "POST",
	            data:  {}, 
	            success: function(response) {
	                $("#table_record").html(response);
	            }
	        });
        }, 1000);
    });

    $(document).on('click','.delete',function(){
    	id = $(this).data("id");

    	$("#table_record").html('<tr><td style="text-align:center" colspan="8"><img src="ajax-loader.gif" width="250px" height="auto"/></td></tr>');

    	setTimeout(function(){
            $.ajax({
	            url: "user_ajax.php",
	            type: "POST",
	            data:  {id:id,action:'delete'}, 
	            success: function(response) {
	                $("#table_record").html(response);
	            }
	        });
        }, 1000);
	});
</script>