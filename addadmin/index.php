<?php
$categary = "Master";
$pagename = "Admin";
if (isset($_GET['edit'])) {
    $subPage = 'Edit';
} else {
    $subPage = 'Add';
}

include '../include/header.php'; ?>
<?php
if (isset($_GET['edit'])) {
    $adminId = base64_decode($_GET['edit']);
    $selectData = mysqli_query($connection, "SELECT * FROM `admin` WHERE `adminId`='" . $adminId . "'");
    $adminArray = mysqli_fetch_array($selectData);
    $firstName = $adminArray['adminName'];

    $roleId = $adminArray['roleId'];
    $mobileNumber = $adminArray['mobileNumber'];
    $email = $adminArray['email'];
    // $password = $adminArray['password'];
}
if (isset($_POST['addAdmin'])) {
    $firstName = $_POST['firstName'];

    $roleId = $_POST['roleId'];
    $mobileNumber = $_POST['mobileNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (strlen($password) == 32) {
        $md5password = $password;
    } else {
        $md5password = md5($password);
    }
    $checkQuery = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `admin` WHERE `email`='" . $email . "' AND `password`='" . $md5password . "' AND `delete`=0"));

    if (isset($_GET['edit'])) {
        $checkQuery = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `admin` WHERE `mobileNumber`='" . $mobileNumber . "' AND `password`='" . $md5password . "' AND `adminId`!='" . $adminId . "' AND `delete`=0"));
        if ($checkQuery > 0) {
            $adminExist = "<div style='color:red;'>Admin Already Exist.</div>";
        } else {
            $insert = mysqli_query($connection, "UPDATE `admin` SET `adminName`='" . $firstName . "', `roleId`='" . $roleId . "',`mobileNumber`='" . $mobileNumber . "',`email`='" . $email . "' WHERE `adminId`='" . $adminId . "'");
            header("location:../viewadmin/");
        }
    } else {
        if ($checkQuery > 0) {
            $adminExist = "<div style='color:red;'>Admin Already Exist.</div>";
        } else {
            $insert = mysqli_query($connection, "INSERT INTO `admin` SET `adminName`='" . $firstName . "', `roleId`='" . $roleId . "',`mobileNumber`='" . $mobileNumber . "',`email`='" . $email . "',`password`='" . $md5password . "'");
            header("location:../viewadmin/");
        }
    }
}

?>
<style>
    .error {
        color: red;
    }
</style>
<!--begin::Card-->
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <div class="card-title">
            <h3 class="card-label">Admin</h3>
        </div>
    </div>
    <!--begin::Form-->
    <form id="addAdmin" method="POST">
        <div class="card-body">
            <?php if (isset($adminExist)) {
                echo $adminExist;
            } ?>
            <div class="form-group">
                <label style="width: 100%;">Admin Name <span class="text-danger">*</span></label>
                <input type="text" style="width: 40%;" name="firstName" class="form-control" placeholder="Enter First Name" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                        echo $firstName;
                                                                                                                                    } ?>">
            </div>

            <div class="form-group">
                <label for="exampleSelect1" style="width: 100%;">Select Role<span class="text-danger">*</span></label>
                <select class="form-control" style="width: 40%;" id="exampleSelect1" name="roleId">
                    <option value="" selected disabled>Select A Role</option>
                    <?php $roleQuery = mysqli_query($connection, "SELECT * FROM `role` WHERE `delete`=0");
                    while ($row = mysqli_fetch_array($roleQuery)) {
                    ?>
                        <option value="<?php echo $row['roleId']; ?>" <?php if (isset($roleId)) {
                                                                            if ($roleId == $row['roleId']) {
                                                                                echo "selected";
                                                                            }
                                                                        } ?>><?php echo $row['roleName']; ?></option>
                    <?php } ?>
                </select>
                <div id="selecttag"></div>
            </div>

            <div class="form-group">
                <label style="width: 100%;">Mobile Number<span class="text-danger">*</span></label>
                <input type="text" style="width: 40%;" name="mobileNumber" class="form-control" placeholder="Enter Mobile Number" value="<?php if (isset($mobileNumber)) {
                                                                                                                                                echo $mobileNumber;
                                                                                                                                            } ?>">
            </div>
            <div class="form-group">
                <label style="width: 100%;">Admin Email <span class="text-danger">*</span></label>
                <input type="text" style="width: 40%;" name="email" class="form-control" placeholder="Enter Email" value="<?php if (isset($email)) {
                                                                                                                                echo $email;
                                                                                                                            } ?>">
            </div>
            <?php if (isset($_GET['edit'])) {
                echo "";
            } else { ?>
                <div class="form-group">
                    <label style="width: 100%;">Create Password<span class="text-danger">*</span></label>
                    <input type="password" style="width: 40%;" name="password" class="form-control" placeholder="Create Password" value="<?php if (isset($password)) {
                                                                                                                                                echo $password;
                                                                                                                                            } ?>">
                </div>
            <?php } ?>

            <button type="submit" id="addAdmin" name="addAdmin" class="btn btn-primary"><?php if (isset($_GET['edit'])) {
                                                                                            echo "Update";
                                                                                        } else {
                                                                                            echo "Add";
                                                                                        } ?></button>

        </div>
    </form>
</div>
<!--end::Card-->
<?php include '../include/footer.php'; ?>
<script>
    $("#exampleSelect1").select2();
    jQuery.validator.addMethod('email_rule', function(value, element) {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)) {
                    return true;
                } else {
                    return false;
                };
            });
    jQuery.validator.addMethod('number_rule', function(value, element) {
        if (/^\(?([6-9]{1})\)?([0-9]{9})$/.test(value)) {
            return true;
        } else {
            return false;
        };
    });
    jQuery.validator.addMethod("laxEmail", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional(element) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test(value);
    }, 'Please enter a valid email address.');
    jQuery.validator.addMethod("onlyAlpha", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
    }, 'Only Alphabets Allowed.');
    $.validator.addMethod("password", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(value);
    }, "Password Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Example: Mesmorizing@123");
    $("#addAdmin").validate({
        rules: {
            firstName: {
                required: true,
                onlyAlpha: true
            },
            lastName: {
                required: true,
                onlyAlpha: true
            },
            roleId: {
                required: true,
            },
            mobileNumber: {
                required: true,
                number: true,
                number_rule:true,
            },
            email: {
                required: true,
                email_rule: true,
            },
            password: {
                required: true,
            }
        },
        messages: {
            firstName: {
                required: "Please Enter First Name.",
            },
            lastName: {
                required: "Please Enter Last Name.",
            },
            roleId: {
                required: "Please Select Role.",
            },
            mobileNumber: {
                required: "Please Enter Mobile Number.",
                number: "Please Enter Valid Number.",
                number_rule: "Please Enter Valid Number.",
               
            },
            email: {
                required: "Please Enter Email.",
                email_rule: "Enter Valid Email.",
            },
            password: {
                required: "Please Enter Password.",
            }
        },
        errorPlacement: function(error, element) {
            //for name attribute
            if (element.attr("name") == "roleId") {
                error.insertAfter("#selecttag");
            } else {
                error.insertAfter(element);
            }
        }
    })
</script>