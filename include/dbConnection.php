<?php

date_default_timezone_set("Asia/Kolkata"); 

ob_start();

session_start();

$serverUsename = $_SERVER["HTTP_HOST"] == "localhost" ? "root":"opener_mesmerizing";

$serverPassword = $_SERVER["HTTP_HOST"] == "localhost" ? "" : 'opener@2022';

$connection = mysqli_connect("localhost", $serverUsename, $serverPassword) or die("Database Connection Failed.");

if(!$connection)

{

	 die("Database Connection Failed : " . mysqli_error($connection));

}

else

{

	mysqli_select_db($connection, "opener_mesmerizingfood") or die("Database Selection Failed : " . mysqli_error($connection));

}
?>