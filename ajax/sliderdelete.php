<?php
include("../include/dbConnection.php");
if($_REQUEST['id']!=" " )
{ 
    $id=$_REQUEST["id"];
    $updatesliderQuery = "UPDATE `slider` SET `delete`= '1' WHERE `imageId`='$id'";
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
