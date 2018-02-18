<?php 
	$servername ="localhost";
	$username="root";
	$password="";
	$db="log";
	$conn=mysqli_connect($servername, $username ,$password) or die("connection failed: ".mysql_connect());
	//echo "connection establised";
	mysqli_select_db($conn,$db);
?>

