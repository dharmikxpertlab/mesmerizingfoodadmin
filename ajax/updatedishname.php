<?php
include '../include/dbConnection.php';
$id = $_REQUEST['id'];
$name= $_REQUEST['name'];



$update = mysqli_query($connection,"UPDATE `dishes` SET `dishName`='".$name."' WHERE `dishId`='".$id."'");
if($update)
{
    echo "Success";
}
?>
