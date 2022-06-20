<?php include '../include/dbConnection.php';
$adminId = $_REQUEST['adminId'];
$DeleteQuery = mysqli_query($connection, "UPDATE `admin` SET `delete`='1' WHERE `adminId`='" . $adminId . "'");
if ($DeleteQuery) {
    echo "Success";
}
