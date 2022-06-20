<?php
include '../include/dbConnection.php';
$id = $_REQUEST['id'];
$rating = $_REQUEST['rating'];
$review = $_REQUEST['review'];
$update = mysqli_query($connection,"UPDATE `rating` SET `rating`='".$rating."',`review`='".$review."' WHERE `ratingId`='".$id."'");
if($update)
{
    echo "Success";
}
?>
