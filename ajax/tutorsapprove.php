<?php
include("../include/dbConnection.php");
if($_REQUEST['id']!=" " )
{ 
    $id=$_REQUEST["id"];
    $updatesliderQuery = "UPDATE `chef` SET `approve`= '1' WHERE `chefId`='$id'";
    $updatesliderResult = mysqli_query($connection,$updatesliderQuery);
   
    if($updatesliderResult != 0) 
	{
        echo "approve";
    }
    else
    {
        echo "not approve";
    }
    
}
?>
