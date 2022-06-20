<?php
$pageName = "Profile";
$subPage = "Settings";
include '../include/header.php'; ?>
<?php

$adminQuery = "SELECT * FROM `admin` WHERE adminId = '" . $_SESSION['admin'] . "'";
$adminResult = mysqli_query($connection, $adminQuery);
$adminRow = mysqli_fetch_array($adminResult);
$pageName = "Profile";
$profile = $adminRow['profile'];
//Take Submit from User
if (isset($_REQUEST['submit'])) {
    $currentPassword = md5($_REQUEST['currentPassword']);
    $newPassword = $_REQUEST['newPassword'];
    $md5Password = md5($newPassword);
    //echo $currentPassword;
    //Match Paswords
    if ($currentPassword == $adminRow['password']) {

        //echo $md5Password;
        $query = "UPDATE admin SET password = '$md5Password' WHERE adminId = '$adminRow[admin]'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        //echo $query;
    } else {
        $passwordMatchError = "<div class='error'>Incorrect Password</div>";
    }
}
if (isset($_REQUEST['submit_user_details'])) {

    $newFirstName = ucfirst(trim($_REQUEST['firstname']));
    //$newLastName = $_REQUEST['lastname'];
    $newPhone = $_REQUEST['phone'];
    $newEmail = $_REQUEST['email'];


    //Check Image 
    if ($_FILES["image"]["name"] == "") {
        $idfront = $adminRow['profile'];
    } else {
        $idfrontfiles = $_FILES["image"]["name"];
        $idfrontTmpLoc = $_FILES["image"]["tmp_name"]; // File in the PHP tmp folder
        $idfrontType = $_FILES["image"]["type"]; // The type of file it is
        $idfrontfileSize = $_FILES["image"]["size"]; // File size in bytes
        $idfrontpath = "../images/";
        $idfronttargetfile = $idfrontpath . basename($idfrontfiles);
        $idfrontfiletype = pathinfo($idfronttargetfile, PATHINFO_EXTENSION);
        $idfrontkaboom = explode(".", $idfrontfiles); // Split file name into an array using the dot
        $idfrontfileExt = end($idfrontkaboom); // Now target the last array element to get the file extension
        $idfrontdate = date("Y-m-d H:i:s");
        $idfronttimestamp = strtotime($idfrontdate);
        $idfront = 'profile' . '-' . $idfronttimestamp . '.' . $idfrontfileExt;
    }

    //

    //While Updating

    move_uploaded_file($idfrontTmpLoc, $idfrontpath . $idfront);

    $query = "UPDATE admin SET `adminName` = '$newFirstName',`mobileNumber`= '$newPhone',
	`profile` ='$idfront' ,`email`='$newEmail' WHERE adminId = '$adminRow[adminId]'";

    $result1 = mysqli_query($connection, $query) or die(mysqli_error($connection));
    //echo $query;
    header('location:../profile/');
}
?>


<style>
    /* Style the tab content */
    .tabcontent {
        display: none;

    }

    .active {
        display: block;

    }

    .error {
        color: red;
    }
</style>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Toolbar-->
    <div class="toolbar" id="kt_toolbar">
        <!--begin::Container-->
        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        </div>
        <!--end::Container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">

                    <!--begin::Navs-->
                    <div class="d-flex overflow-auto h-55px">
                        <ul class=" nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class=" <?php if (!isset($passwordMatchError)) {
                                                echo "active";
                                            } ?> nav-link text-active-primary me-6 tablinks" onclick="openTab(event, 'tab1')">Overview</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6 tablinks" onclick="openTab(event, 'tab2')">Profile Settings</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class="<?php if (isset($passwordMatchError)) {
                                                echo "active";
                                            } ?> nav-link text-active-primary me-6 tablinks" onclick="openTab(event, 'tab3')">Change Password</a>
                            </li>
                            <!-- begin Javascript -->
                            <script>
                                function openTab(evt, tabName) {
                                    // Declare all variables
                                    var i, tabcontent, tablinks;

                                    // Get all elements with class="tabcontent" and hide them
                                    tabcontent = document.getElementsByClassName("tabcontent");
                                    for (i = 0; i < tabcontent.length; i++) {
                                        tabcontent[i].style.display = "none";
                                    }

                                    // Get all elements with class="tablinks" and remove the class "active"
                                    tablinks = document.getElementsByClassName("tablinks");
                                    for (i = 0; i < tablinks.length; i++) {
                                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                                    }

                                    // Show the current tab, and add an "active" class to the button that opened the tab
                                    document.getElementById(tabName).style.display = "block";
                                    evt.currentTarget.className += " active";
                                }
                            </script>

                            <!-- End Javsscript -->
                            <!--end::Nav item-->

                        </ul>
                    </div>
                    <!--begin::Navs-->
                </div>
            </div>
            <!--end::Navbar-->

            <div id="tab1" class="tabcontent <?php if (!isset($passwordMatchError)) {
                                                    echo "active";
                                                } ?>">
                <!--begin:: profile details View-->
                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Overview</h3>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->

                    <div class="card-body p-9">
                        <!-- begin Row profile image   -->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Profile Picture</label>
                            <!--end::Label-->
                            <img src="../images/<?php if ($profile == "") {
                                                    $profile = "blank.png";
                                                }
                                                echo $profile; ?>" style="height: 100px; width:100px;" alt="" srcset="">
                            <!-- End Row profile image   -->
                        </div>
                        <!--begin::Row-->
                        <div class=" row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Full Name</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800"><?php echo $adminRow["adminName"]; ?></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">Mobile Number
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bolder fs-6 text-gray-800 me-2"><?php echo $adminRow["mobileNumber"] ?></span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">E-mail
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bolder fs-6 text-gray-800 me-2"><?php echo $adminRow["email"] ?></span>

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex  py-6 px-9">




                        </div>
                        <!--end::Actions-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::profile details  View-->

                <!--begin::Row-->

            </div>

            <div id="tab2" class="tabcontent">


                <!-- begin profile settings view -->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Profile Details</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_profile_details_form" name="submit_user_details" method="POST" class="form fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data" novalidate="novalidate">
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Image input-->
                                        <div class="image-input image-input-outline" data-kt-image-input="true">

                                            <!--begin::Preview existing avatar-->
                                            <?php if ($profile == "") {
                                                $profile = "blank.png";
                                            }
                                            echo  '<div class="image-input-wrapper w-125px h-125px" style="background-image: url(../images/' . $profile . ')"></div> '
                                            ?>
                                            <!--end::Preview existing avatar-->
                                            <!--begin::Label-->
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="" data-bs-original-title="Change avatar">
                                                <i class="fa fa-edit"></i>
                                                <!--begin::Inputs-->
                                                <input type="file" name="image" id="profileImage" accept=".png, .jpg, .jpeg" style="display: none;">
                                                <input type="hidden" name="avatar_remove">
                                                <!--end::Inputs-->
                                            </label>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Image input-->
                                        <!--begin::Hint-->
                                        <div class="form-text" id="validimage">Allowed file types: png, jpg, jpeg.</div>
                                        <!--end::Hint-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                <input type="text" name="firstname" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="First name" value="<?php echo $adminRow["adminName"] ?>">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <!--end::Col-->

                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span class="required">Mobile Number</span>

                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="tel" name="phone" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="<?php echo $adminRow["mobileNumber"] ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span class="required">Email</span>

                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="tel" name="email" class="form-control form-control-lg form-control-solid" placeholder="Phone number" value="<?php echo $adminRow["email"] ?>">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex  py-6 px-9">

                                <button type="submit" name="submit_user_details" class="btn apac-grad" id="kt_account_profile_details_submit">Change Profile</button>


                            </div>
                            <!--end::Actions-->
                            <input type="hidden">
                            <div></div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!-- end profile settings view -->
            </div>
            <!-- begin change password settings view -->
            <div id="tab3" class="tabcontent <?php if (isset($passwordMatchError)) {
                                                    echo "active";
                                                } ?>">
                <!-- begin profile settings view -->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Change Password</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_profile_details" class="collapse show">
                        <!--begin::Form-->

                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">

                            <!--Begin form -->
                            <form class="form w-100" id="kt_change_password_form" method="POST">

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Current Password</label>

                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8">
                                        <!--begin::Row-->
                                        <div class="row">
                                            <!--begin::Col-->
                                            <div class="col-lg-12 fv-row fv-plugins-icon-container">
                                                <input type="password" name="currentPassword" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Current Password" value="">
                                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                            </div>
                                            <?php
                                            if (isset($passwordMatchError)) {
                                                echo $passwordMatchError;
                                            }
                                            ?>

                                            <!--end::Col-->

                                        </div>
                                        <!--end::Row-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span class="required">New Password</span>

                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="password" name="newPassword" id="newPassword" class="form-control form-control-lg form-control-solid" placeholder="New Password" value="">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>

                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="row mb-6">
                                    <!--begin::Label-->
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">
                                        <span class="required">Confirm Password</span>

                                    </label>
                                    <!--end::Label-->
                                    <!--begin::Col-->
                                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                        <input type="password" name="confirmPassword" id="confirmPassword" class="form-control form-control-lg form-control-solid" placeholder="Confirm Password">
                                        <div class="fv-plugins-message-container invalid-feedback"></div>
                                    </div>
                                    <?php if (isset($confirmPassworderror)) {
                                        echo $confirmPassworderror;
                                    } ?>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->



                                <!--begin::Actions-->
                                <div class="card-footer d-flex  py-6 px-9">

                                    <button type="submit" name="submit" class="btn apac-grad" id="">Change Password</button>

                                </div>
                                <!--end::Actions-->

                            </form>
                            <!-- End form -->


                        </div>
                        <!--end::Card body-->





                        <div></div>

                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!-- end profile settings view -->

            </div>
            <!--begin::Card header-->

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<?php
include '../include/footer.php';

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<!-- <script>
    $("#profileImage").on("change", function() {
        $("#profileImage").attr("src", base64data);
    })
</script> -->

<script>
    if (<?php if (isset($result)) {
            echo "5";
        } else {
            echo "3";
        } ?> == 5) {
        toastr.success("Password Updated Succesfully.");

    }
    $.validator.addMethod("passwordregex", function(value, element) {
        return this.optional(element) || /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/.test(value);
    }, "Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters. Example: Admin@123");
    $("#kt_change_password_form").validate({
        rules: {
            currentPassword: {
                required: true
            },
            newPassword: {
                required: true,
                passwordregex: true
            },
            confirmPassword: {
                required: true,
                equalTo: "#newPassword"
            },

        },
        messages: {
            currentPassword: {
                required: "Current Password Required"
            },
            newPassword: {
                required: "New Password Required"
            },
            confirmPassword: {
                required: "Please Confirm Password",
                equalTo: "Passwords Doesn't Match."
            }
        },



    })
    jQuery.validator.addMethod("laxEmail", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
    }, 'Please enter a valid email address.');
    $.validator.addMethod("space", function(value, element) {
        return this.optional(element) || /^\S*$/i.test(value);
    }, "No white space please");
    jQuery.validator.addMethod("onlyAlpha", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional(element) || /^[a-zA-Z\-\s]+$/.test(value);
    }, 'Only Alphabets Allowed.');
    jQuery.validator.addMethod("Image", function(value, element) {
        // allow any non-whitespace characters as the host part
        return this.optional(element) || /.*\.(gif|jpe?g|bmp|png)$/i.test(value);
    }, 'Select Valid Image.');
    jQuery.validator.addMethod('number_rule', function(value, element) {
                if (/^\(?([6-9]{1})\)?([0-9]{9})$/.test(value)) {
                    return true;
                } else {
                    return false;
                };
            });
    $("#kt_account_profile_details_form").validate({


        rules: {
            avtar: {

                Image: true,

            },
            firstname: {

                required: true,
                onlyAlpha: true,

            },
            lastname: {
                required: true,
                onlyAlpha: true,
            },
            phone: {
                required: true,
                number: true,
                number_rule: true,
            },
            email: {
                required: true,
                laxEmail: true,
            }
        },
        messages: {
            avtar: {

            },
            firstname: {
                required: "Please First Enter name.",
                onlyAlpha: "Only Alphabets Allowed.",

            },
            lastname: {
                required: "Please Last Enter name."
            },
            phone: {
                required: "Please Enter Contact Number.",
                number: "Please Enter Valid Number.",
                number_rule: "Please Enter Valid Number.",
                
            },
            email: {
                required: "Please Enter Email.",
                LaxEmail: "Enter Valid Email."
            }
        },
        errorPlacement: function(error, element) {
            //for name attribute
            if (element.attr("name") == "avtar") {
                error.insertAfter("#validimage");
            }

            //for rest of the elements, keeping same position
            else {
                error.insertAfter(element);
            }
        }

    })
</script>
