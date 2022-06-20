<?php
include("../include/dbConnection.php");
if ($_REQUEST['id'] != " ") {
    $id = $_REQUEST["id"];
    $updatesliderQuery = "UPDATE `language` SET `delete`= '1' WHERE `languageId`='$id'";
    $updatesliderResult = mysqli_query($connection, $updatesliderQuery);

    if ($updatesliderResult != 0) {
        echo "delete";
    } else {
        echo "not delete";
    }
}
