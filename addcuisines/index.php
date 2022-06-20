<?php
$categary = "Master";
$pagename = isset($_GET['edit']) ? "Edit Category" : "Add Category";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editcuisineName=mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$id'"));
	}
    
	//ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
        $name = ucfirst(trim($_POST['name']));
        $incomeratio = $_POST['incomeratio'];
        
        
        if($name==""){
            $nameError="<div class='error'>Category Required</div>";
			$flag=0;
        }
        $imagefiles =strtolower(trim($_FILES['newCarousal']['name']));
        if(!isset($_GET['edit']))
        {
        
            $imageTmpLoc = $_FILES["newCarousal"]["tmp_name"]; // File in the PHP tmp folder
            $imageType = $_FILES["newCarousal"]["type"]; // The type of file it is
            $imagefileSize = $_FILES["newCarousal"]["size"]; // File size in bytes
            $imagepath = "../images/cuisines/";
            $imagetargetfile = $imagepath . basename($imagefiles); 
            $imagefiletype = pathinfo($imagetargetfile,PATHINFO_EXTENSION);
            $imagekaboom = explode(".", $imagefiles); // Split file name into an array using the dot
            $imagefileExt = end($imagekaboom); // Now target the last array element to get the file extension
            $imagedate = date("Y-m-d H:i:s");
            $imagetimestamp = strtotime($imagedate);
            $categoryimage = 'cuisines'. '-'.$imagetimestamp.'.'. $imagefileExt;
            
            
            if($imagefileExt=="" && !isset($_GET['edit'])){
                $mediumError = "<div class='error'>Select Image</div>";
                $flag=0;
            }
            
            move_uploaded_file($imageTmpLoc,$imagepath. $categoryimage);
        }else{

            if($imagefiles != ""){

                $imageTmpLoc = $_FILES["newCarousal"]["tmp_name"]; // File in the PHP tmp folder
                $imageType = $_FILES["newCarousal"]["type"]; // The type of file it is
                $imagefileSize = $_FILES["newCarousal"]["size"]; // File size in bytes
                $imagepath = "../images/cuisines/";
                $imagetargetfile = $imagepath . basename($imagefiles); 
                $imagefiletype = pathinfo($imagetargetfile,PATHINFO_EXTENSION);
                $imagekaboom = explode(".", $imagefiles); // Split file name into an array using the dot
                $imagefileExt = end($imagekaboom); // Now target the last array element to get the file extension
                $imagedate = date("Y-m-d H:i:s");
                $imagetimestamp = strtotime($imagedate);
                $categoryimage = 'cuisines'. '-'.$imagetimestamp.'.'. $imagefileExt;

                move_uploaded_file($imageTmpLoc,$imagepath. $categoryimage);
            }else{
                $categoryimage = $editcuisineName['cuisineImage'];
            }
        }
        
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				mysqli_query($connection,"UPDATE `cuisines` SET `cuisineName` = '$name',`cuisineImage` = '$categoryimage',`incomeRatio`='$incomeratio' where `cuisineId` = '$id'") or die(mysqli_error($connection));
				// echo "done";
                // exit;
				$editSuccess=1;
                // echo $editSuccess;
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `cuisines` SET `cuisineName` = '$name',`cuisineImage` = '$categoryimage',`incomeRatio`='$incomeratio'") or die(mysqli_error($connection));
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
				<form class="form" method="post" id="myForm" enctype="multipart/form-data">
					<div class="card-body">
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Category Name</strong> </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?php if(isset($name)) { echo $name; } else if(isset($_GET['edit'])) { echo $editcuisineName['cuisineName']; } ?>"  name="name"  placeholder="Enter Name" />
                            <?php if(isset($nameError)) { echo $nameError; } ?>
                        </div>
                    </div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Select Image</strong> </label>
							<div class="col-lg-4">
								<input type="file" class="form-control"  name="newCarousal" />
								<?php if(isset($mediumError)) { echo $mediumError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Income Ratio</strong> </label>
							<div class="col-lg-4">
								<div class="input-group">

									<input type="text" class="form-control" value="<?php if(isset($incomeratio)) { echo $incomeratio; } else if(isset($_GET['edit'])) { echo $editcuisineName['incomeRatio']; } ?>"  name="incomeratio" placeholder="Income Ratio" />
								
								</div>
								<span id="incomeratioError"></span>
								<?php if(isset($incomeratioError)) { echo $incomeratioError; } ?>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								<button onClick="window.location.href='../cuisines/';" type="button"  class="btn btn-secondary">Cancel</button>
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

            jQuery.validator.addMethod('name_rule', function(value, element) {
                if (/^[a-zA-Z]+$/.test(value)) {
                    return true;
                } else {
                    return false;
                };
            });
            jQuery.validator.addMethod('incomeratio_role', function(value, element) {
                if (value>=20 && value<=80) {
                    return true;
                } else {
                    return false;
                };
            });

            // validation
        $('#myForm').validate({
			rules: {
				name:{
					required: true,
                    name_rule:true,
				},

                newCarousal:{
                    <?php if(!isset($_GET['edit'])){ 
                        
                         echo"required: true";

                      }?>
                },

                
                incomeratio:{
                    required: true,
					number:true,
					incomeratio_role:true,
				}
				
			},
			messages: {
				name:{
					required: "Enter Cuisines Name",
                    name_rule:"Enter Valid Cuisines Name",
				},
				
				newCarousal:{
                    required: "Select Image",
                },
                incomeratio:{
                    required:"Enter Income Ratio",
					number:"Enter Number only",
					incomeratio_role:"between 20-80",
				}
			},
			
            errorPlacement: function(error, element) { // render error placement for each input type
                 if (element.attr('name') == 'incomeratio') {
                    error.appendTo("#incomeratioError");
                }  else {
                    error.insertAfter(element);
                }
		    }			

		 })
         // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
        window.location.href='../addcuisines/';
   
   <?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
       
        window.location.href='../cuisines/';
        // alert();
   
   <?php } ?>

    // display toastr on success
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success("Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    
</script>