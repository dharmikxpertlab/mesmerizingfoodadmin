<?php include '../include/dbConnection.php';
$adminId = $_REQUEST['adminId'];
$DeleteQuery = mysqli_query($connection, "UPDATE `admin` SET `status`='0' WHERE `adminId`='" . $adminId . "'");
if ($DeleteQuery) {
    echo "Success";
}
