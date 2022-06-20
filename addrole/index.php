<?php
$categary = "Master";
$pagename = "Role";
if (isset($_GET['edit'])) {
    $subPage = "Edit";
} else {
    $subPage = "Add";
}
include '../include/header.php';
?>
<?php
if (isset($_GET['edit'])) {
    $roleId = base64_decode($_GET['edit']);
    $selectData = mysqli_query($connection, "SELECT * FROM `role` WHERE `roleId`='" . $roleId . "'");
    $roleArray = mysqli_fetch_array($selectData);
    $role = $roleArray['roleName'];
}
if (isset($_POST['addrole'])) {
    $flag = 1;
    $role = $_POST['role'];
    if ($role == "") {
        $flag = 0;
    }
    $checkQuery = mysqli_query($connection, "SELECT * FROM `role` WHERE `roleName`='" . $role . "'");
    $count = mysqli_num_rows($checkQuery);
    if ($flag == 1) {
        if (isset($_GET['edit'])) {
            $checkEditQuery = mysqli_query($connection, "SELECT * FROM `role` WHERE `roleName`='" . $role . "' AND `roleId`!='" . $roleId . "'");
            $rowcount = mysqli_num_rows($checkEditQuery);
            if ($rowcount > 0) {
                $exists = "<div style='color:red;'>Role Already Exists</div>";
            } else {
                $Updaterole = mysqli_query($connection, "UPDATE `role` SET `roleName`='" . $role . "' WHERE `roleId`='" . $roleId . "'");
                header("location:../viewrole/");
            }
        } else {
            if ($count > 0) {
                $exists = "<div style='color:red;'>Role Already Exists</div>";
            } else {
                $addrole = mysqli_query($connection, "INSERT INTO `role` SET `roleName`='" . $role . "'");
                header("location:../viewrole/");
            }
        }
    }
}

?>
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Role
        </h3>
    </div>
    <!--begin::Form-->
    <form id="addrole" method="POST">
        <div class="card-body">
            <?php if (isset($exists)) {
                echo $exists;
            } ?>
            <div class="form-group">
                <label style="width: 100%;">Role Name <span class="text-danger">*</span></label>
                <input type="text" style="width: 40%;" name="role" class="form-control" placeholder="Enter role Name" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                    echo $role;
                                                                                                                                } ?>" />
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" id="addrole" name="addrole" class="btn btn-primary mr-2"><?php if (isset($_GET['edit'])) {
                                                                                                echo "Update";
                                                                                            } else {
                                                                                                echo "Add";
                                                                                            } ?></button>
            <a href="../viewrole/" type="reset" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
    <!--end::Form-->
</div>
<?php
include '../include/footer.php';
?>
<script>
    jQuery.validator.addMethod("onlyAlpha", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional(element) || /^[A-Za-z0-9\s]+$/.test(value);
    }, 'Only Alphabets Allowed.');
    $("#addrole").validate({
        rules: {
            role: {
                required: true,
                onlyAlpha: true,
            }
        },
        messages: {
            role: {
                required: "Please Enter Role.",
            }
        }
    })
</script>