<?php
session_start();
?>

<nav style="background:#2c3e50;padding:10px;color:white;display:flex;align-items:center;justify-content:space-between;">

<div style="font-size:20px;font-weight:bold;">
Smart Clinic
</div>

<div class="dropdown">

<button onclick="toggleMenu()" style="background:none;border:none;color:white;font-size:16px;cursor:pointer;">
👤 <?php echo $_SESSION['username']; ?>
</button>

<div id="menu" style="display:none;position:absolute;background:white;color:black;padding:10px;border-radius:5px;right:20px;">


<a href="change_password.php" style="display:block;padding:5px;">Change Password</a>

<?php if($_SESSION['role']=="user"){ ?>

<a href="my_booking.php" style="display:block;padding:5px;">My Bookings</a>

<?php } ?>

<a href="logout.php" style="display:block;padding:5px;color:red;">Logout</a>

</div>

</div>

</nav>

<script>

function toggleMenu(){

var menu=document.getElementById("menu");

if(menu.style.display=="none"){
menu.style.display="block";
}else{
menu.style.display="none";
}

}

</script>