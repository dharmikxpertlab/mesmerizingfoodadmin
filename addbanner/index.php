<?php
$categary = "Master";
$pagename = isset($_GET['edit']) ? "Edit Banner" : "Add Banner";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editUser=mysqli_fetch_array(mysqli_query($connection,"select * from `slider` where `imageId` = '$id'"));
	}
    
	//ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
		
        $imagefiles =strtolower(trim($_FILES['newCarousal']['name']));
        $imageTmpLoc = $_FILES["newCarousal"]["tmp_name"]; // File in the PHP tmp folder
        $imageType = $_FILES["newCarousal"]["type"]; // The type of file it is
        $imagefileSize = $_FILES["newCarousal"]["size"]; // File size in bytes
        $imagepath = "../images/carousal/";
        $imagetargetfile = $imagepath . basename($imagefiles); 
        $imagefiletype = pathinfo($imagetargetfile,PATHINFO_EXTENSION);
        $imagekaboom = explode(".", $imagefiles); // Split file name into an array using the dot
        $imagefileExt = end($imagekaboom); // Now target the last array element to get the file extension
        $imagedate = date("Y-m-d H:i:s");
        $imagetimestamp = strtotime($imagedate);
        $driverimage = 'banner'. '-'.$imagetimestamp.'.'. $imagefileExt;
        if($imagefileExt==""){
            $mediumError = "<div class='error'>Select Image</div>";
            $flag=0;
        }
        
        move_uploaded_file($imageTmpLoc,$imagepath. $driverimage);
        
        
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				mysqli_query($connection,"UPDATE `slider` SET `type` = 'add', `images` = '$driverimage' where `imageId` = '$id'") or die(mysqli_error($connection));
				
				$editSuccess=1;
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `slider` SET `type` = 'add', `images`  = '$driverimage'") or die(mysqli_error($connection));
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
			<div class="card card-custom">
				<div class="card-header">
					<h3 class="card-title"><?php echo $pagename; ?></h3>
				</div>
				<!--begin::Form-->
				<form class="form" method="post" id="myForm" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Select Image</strong> </label>
							<div class="col-lg-4">
								<input type="file" class="form-control"  name="newCarousal"  />
								<?php if(isset($mediumError)) { echo $mediumError; } ?>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								<button onClick="window.location.href='../banner/';" type="button"  class="btn btn-secondary">Cancel</button>
								<button type="submit" name="save" class="btn btn-primary cebutton mr-2"><?php echo $save;?></button>
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
<script>
    // display toastr on success
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success("Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../addbanner/';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../banner/';
	
	<?php } ?>
</script>