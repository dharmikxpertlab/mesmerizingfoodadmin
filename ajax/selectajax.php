<?php
include("../include/dbConnection.php");
if (isset($_POST['getsubCategory']) == "getsubCategory") {
    $categoryId = $_POST['categoryId'];
   
    $result = mysqli_query($connection,"select * from `dishes` where `delete` = '0' and `cuisineId`= $categoryId");
    $stateData = '<option value="">subCategory</option>';
    
    if ($result->num_rows>0){
        while ($row = mysqli_fetch_assoc($result)) {
            
            $stateData .= '<option value="'.$row["dishId"].'">'.$row["dishName"].'</option>';
        }
    }
    echo "test^".$stateData;
}
