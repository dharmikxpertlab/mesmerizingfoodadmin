<?php
include("../include/dbConnection.php");
if($_REQUEST['id']!=" " )
{ 
    $id=$_REQUEST["id"];
    $reason=$_REQUEST["reason"];
    $updatesliderQuery = "UPDATE `chef` SET `approve`= '2',`reason`= '$reason'  WHERE `chefId`='$id'";
    $updatesliderResult = mysqli_query($connection,$updatesliderQuery);
   
    if($updatesliderResult != 0) 
	{
        echo "denied";
    }
    else
    {
        echo "not denied";
    }
    
}
?>
