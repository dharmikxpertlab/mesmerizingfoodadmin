<?php
$categary = "userapp";
$pagename = isset($_GET['edit']) ? "Edit User" : "Add User";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";
$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editUser=mysqli_fetch_array(mysqli_query($connection,"select * from `user` where `userId` = '$id'"));
	}
    
	//ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
		
        $fullName =ucfirst(trim($_POST['fullName']));
        $email = trim($_POST['email']);
        $number = trim($_POST['number']);
        $dob = $_POST['dateOfBirth'];
        $country = ucfirst(trim($_POST['country']));
        $city = ucfirst(trim($_POST['city']));
        // $languages = $_POST['languages'];
		$mediumError="";
		$emailError="";
        $numberError="";

		// PHP VALIDATION
		if($fullName=="")
		{
			$mediumError="<div class='error'>FullName Required</div>";
			$flag=0;
		}
        if($email=="")
		{
			$emailError="<div class='error'>Email Required</div>";
			$flag=0;
		}
        else if(mysqli_num_rows(mysqli_query($connection,"select * from `user` where `email` = '$email' and `delete` = '0'"))>0)
		{
			if(!isset($_GET['edit'])) 
			{
				$emailError="<div class='error'>Email Exists</div>";
				$flag=0;
			}
			else if($editUser['email']!=$email)
			{
				$emailError="<div class='error'>Email Exists</div>";
				$flag=0;
			}	
		}
        if($number=="")
		{
			$numberError="<div class='error'>Mobile Number Required</div>";
			$flag=0;
		}

		if($dob==""){

            $flag=0;
        }else{
            $newDob = date("Y-m-d", strtotime($dob));
        }

        if($country==""){
			$countryError="<div class='error'>Country Required</div>";
            $flag=0;
        }
        if($city==""){
			$cityError="<div class='error'>City Required</div>";
            $flag=0;
        }
        
	
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				mysqli_query($connection,"UPDATE `user` SET `fullName` = '$fullName',`email` = '$email', `mobileNumber` = '$number',`dateOfBirth`='$newDob' , `country`='$country' ,`city`= '$city' WHERE `userId` = '".$id."'") or die(mysqli_error($connection));
				
				$editSuccess=1;
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `user` SET `fullName` = '$fullName',`email` = '$email', `mobileNumber` = '$number',`dateOfBirth`='$newDob' , `country`='$country' ,`city`= '$city'") or die(mysqli_error($connection));
				$success=1;
			}
        }
    }

?>
<style>
    .error{
        color: red;
    }
</style>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- begin::Subheader -->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo $categary;?></h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $pagename; ?></span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
           
        </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
			<div class="card card-custom ">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pagename; ?></h3>
				</div>
				<!--begin::Form-->
				<form class="form" method="post" id="myform" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Full Name</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($fullName)) { echo $fullName; } else if(isset($_GET['edit'])) { echo $editUser['fullName']; } ?>"  name="fullName"  placeholder="Enter User Name" />
								<?php if(isset($mediumError)) { echo $mediumError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Email</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($email)) { echo $email; } else if(isset($_GET['edit'])) { echo $editUser['email']; } ?>"  name="email"  placeholder="Enter Email" />
								<?php if(isset($emailError)) { echo $emailError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Mobile Number</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($number)) { echo $number; } else if(isset($_GET['edit'])) { echo $editUser['mobileNumber']; } ?>"  name="number"  placeholder="Enter Mobile Number" />
								<?php if(isset($numberError)) { echo $numberError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Date Of Birth</strong> </label>
							<div class="col-lg-4">
								<input type="date" class="form-control" value="<?php if(isset($dob)) { echo $dob; } else if(isset($_GET['edit'])) { echo $editUser['dateOfBirth']; } ?>"  name="dateOfBirth" max="<?php $time = new DateTime('now'); echo $time->modify('-18 year')->format('Y-m-d'); ?>" min ="<?php $time = new DateTime('now'); echo $time->modify('-110 year')->format('Y-m-d'); ?>"  />
								<?php if(isset($dobError)) { echo $dobError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Country</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($country)) { echo $country; } else if(isset($_GET['edit'])) { echo $editUser['country']; } ?>"  name="country"   />
								<?php if(isset($countryError)) { echo $countryError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>City</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($city)) { echo $city; } else if(isset($_GET['edit'])) { echo $editUser['city']; } ?>"  name="city"   />
								<?php if(isset($cityError)) { echo $cityError; } ?>
							</div>
						</div>
                        <!-- <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Gender</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($gender)) { echo $gender; } else if(isset($_GET['edit'])) { echo $editUser['gender']; } ?>"  name="gender"   />
								<?php if(isset($genderError)) { echo $genderError; } ?>
							</div>
						</div> -->
                        <!-- <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Languages</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($languages)) { echo $languages; } else if(isset($_GET['edit'])) { echo $editUser['languages']; } ?>"  name="languages"   />
								<?php if(isset($languagesError)) { echo $languagesError; } ?>
							</div>
						</div> -->


					</div>


					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								
								<button onClick="window.location.href='../users/';" type="button"  class="btn btn-secondary">Cancel</button>
								<button type="submit" name="save" class="btn  btn-primary cebutton mr-2"><?php echo $save;?></button>
							</div>
						</div>
					</div>
                    
                    
				</form>
				<!--end::Form-->
			</div>
			<!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->


<?php
include "../include/footer.php";
?>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<script>
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
			jQuery.validator.addMethod('name_rule', function(value, element) {
                if (/^[a-zA-Z]+$/.test(value)) {
                    return true;
                } else {
                    return false;
                };
            });

		 $('#myform').validate({
			rules: {
				fullName:{
					required: true,
				},
				email:{
					required: true,
					email_rule: true,
				},
				number:{
					required: true,
                    number_rule: true,
				},
				dateOfBirth:{
					required: true,
				},
				country:{
					required: true,
					name_rule:true, 
				},
				city:{
					required: true,
					name_rule:true, 
				},
			},
			messages: {
				fullName:{
					required: "Enter FullName",
				},
				email:{
					required: "Enter Email",
					email_rule: "Email is not valid",
				},
				number:{
					required: "Enter Number",
                    number_rule: "not valid number",
				},
				dateOfBirth:{
					required: "Select Date",

				},
				country:{
					required: "Enter Country Name",
					name_rule: "not valid Country Name", 
				},
				city:{
					required: "Enter City Name",
					name_rule: "not valid City Name", 
				},
			}


		 })



    // display toastr on success
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success(" Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../adduser/';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../users/';
	
	<?php } ?>
</script>