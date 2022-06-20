<?php
include '../include/dbConnection.php';
$id = $_REQUEST['id'];

$update = mysqli_query($connection,"UPDATE `rating` SET `delete`=1 WHERE `ratingId`='".$id."'");
if($update)
{
    echo "Success";
}
