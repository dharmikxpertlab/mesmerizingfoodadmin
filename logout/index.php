<?php
	include("../include/dbConnection.php");
	
	if(isset($_SESSION['admin']))
	{
		unset($_SESSION['admin']);
	}
	
	header("location:../");
?>