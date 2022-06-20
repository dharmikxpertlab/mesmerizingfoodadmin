<?php
include("../include/dbConnection.php");
if($_REQUEST['id']!=" " )
{ 
    $id=$_REQUEST["id"];
    $updatesliderQuery = "UPDATE `dishes` SET `delete`= '1' WHERE `dishId`='$id'";
    $updatesliderResult = mysqli_query($connection,$updatesliderQuery);
   
    if($updatesliderResult != 0) 
	{
        echo "delete";
    }
    else
    {
        echo "not delete";
    }
    
}
?>