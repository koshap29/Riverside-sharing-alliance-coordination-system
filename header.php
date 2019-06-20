<header class="main-header" id="main-header">
	<div class="header-chunk pen-title-area">
		<div class="pen-title-text">
			<h1 id="pen-title" class="pen-title">
				<a class="pen-title-link" href="#">
					KOSHA
				</a>
			</h1>
		</div>
	</div>

	<div class="header-chunk primary-actions secondary-nav">
		<div class="signup-and-login">
			<a href="#" onclick="myFunction();"><img src="burger.png" class="dropbtn"></a>
			<div id="myDropdown" class="dropdown-content">
			    <a href="site.php">Site</a>
			    <a href="client.php">Client</a>
			    <a href="waitlist.php">Waitlist</a>
			    <a href="user.php">User</a>
			    <a href="checkin.php">Check In</a>
			    <a href="service.php">Service</a>
                <a href="soupkitchen.php">Soup Kitchen</a>
                <a href="shelter.php">Shelter</a>
                <a href="room.php">Room</a>
                <a href="item.php">Item</a>
                <a href="clientservice.php">Client Service</a>
                <a href="donation.php">Donation</a>
                <a href="foodbank.php">Food Bank</a>
                <a href="foodpantry.php">Food Pantry</a>
                <a href="itemrequests.php">Item Requests</a>
			</div>
		</div>
	</div>
</header>
<script>
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;

    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>