<?php
$categary = "Master";
$pagename = "Admin";
include '../include/header.php'; ?>
<?php $adminId = base64_decode($_GET['edit']);
//$checkQuery = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `admin` WHERE `adminId`='" . $adminId . "' AND `password`='" . $md5password . "'"));
if (isset($_POST['update'])) {
    $newPassword = md5($_POST['password']);
    // echo $newPassword;
    // echo "UPDATE `admin` SET `password` = '" . $newPassword . "' WHERE `adminId`='" . $adminId . "'";
    $updateQuery = mysqli_query($connection, "UPDATE `admin` SET `password` = '" . $newPassword . "' WHERE `adminId`='" . $adminId . "'");
    //header("location:../viewadmin/");
    $_SESSION['adminpassword'] = "success";
}
?>
<style>
    .error{
        color:red;
    }
</style>
<!--begin::Card-->
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Change Password</h3>
        </div>
    </div>
    <!--begin::Form-->
    <form id="update" method="POST">
        <div class="card-body">



            <div class="form-group">
                <label>New Password<span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter New Password" value="">
            </div>
            <div class="form-group">
                <label>Re-Enter New Password<span class="text-danger">*</span></label>
                <input type="password" name="confirmPassword" class="form-control" placeholder="Re-Enter New Password" value="">
            </div>



            <button type="submit" id="update" name="update" class="btn btn-primary">Update</button>

        </div>
    </form>
</div>
<!--end::Card-->
<?php include '../include/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $("#update").validate({
        rules: {
            password: {
                required: true
            },
            confirmPassword: {
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Enter Password."
            },
            confirmPassword: {

                equalTo: "Passwords Dosen't Match.",
            }
        }
    })
</script>