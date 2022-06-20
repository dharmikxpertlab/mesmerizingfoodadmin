
<?php
include '../include/dbConnection.php';
$roleId = $_REQUEST['roleId'];
$DeleteQuery = mysqli_query($connection, "UPDATE `role` SET `delete`='1' WHERE `roleId`='" . $roleId . "'");
if ($DeleteQuery) {
    echo "Success";
}
