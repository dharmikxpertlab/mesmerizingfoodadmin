<?php
$categary = "Setting";
$pagename = "Payable Amount Ratio";
$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL

    $editRatio=mysqli_fetch_array(mysqli_query($connection,"select rocCommision,webinarCommision,coursesCommision from `setting` where `settingId` = '1'"));

    // $cuisine = mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$cuisineId'"));

    //ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
        $rocCommision = trim($_POST['rocCommision']);
        $webinarCommision = trim($_POST['webinarCommision']);
        $coursesCommision = trim($_POST['coursesCommision']);

        if($rocCommision ==""){
            $ratioError="<div class='error'>Recipe on call Ratio Required</div>";
			$flag=0;
        }
        if($webinarCommision ==""){
            $ratioError="<div class='error'>Webinar Ratio Required</div>";
			$flag=0;
        }
        if($coursesCommision ==""){
            $ratioError="<div class='error'>Courses Ratio Required</div>";
			$flag=0;
        }
      
        if($flag == 1)
		{
				mysqli_query($connection,"UPDATE `setting` SET 
                `rocCommision` = '$rocCommision',
                `webinarCommision` = '$webinarCommision',
                 `coursesCommision` = '$coursesCommision'
                where `settingId` = '1'") or die(mysqli_error($connection));
				$editSuccess=1;
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
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;"></span><strong></strong> </label>
                            <div class="col-lg-2">
                            <label class="" style="margin-top: 10px;"><span style="color:red;font-size:15px;"></span><strong>Tutor</strong> </label>
                            </div>
                            <div class="col-lg-2">
                            <label class="" style="margin-top: 10px;"><span style="color:red;font-size:15px;"></span><strong>Compny</strong> </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Recipe on call (ROC)</strong> </label>
                            <div class="col-lg-2">
                                <input type="number" class="form-control" value="<?php if(isset($rocCommision)) { echo $rocCommision; } else { echo $editRatio['rocCommision']; } ?>"  name="rocCommision" id="rocCommisionId"  placeholder="Set Ratio for ROC" />
                            </div><div class="col-lg-2">
                                <input type="number" id="rocCommisionId2" readonly class="form-control" value="<?php if(isset($rocCommision)) { echo 100 - $rocCommision; } else { echo 100 - $editRatio['rocCommision']; } ?>" />
                                <?php if(isset($ratioError)) { echo $ratioError; } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Webinar</strong> </label>
                            <div class="col-lg-2">
                                <input type="number" id="webinarCommisionId" class="form-control" value="<?php if(isset($webinarCommision)) { echo $webinarCommision; } else { echo $editRatio['webinarCommision']; } ?>"  name="webinarCommision"  placeholder="Set Ratio" />
                                </div><div class="col-lg-2">
                                <input type="number" id="webinarCommisionId2" readonly class="form-control" value="<?php if(isset($webinarCommision)) { echo 100 - $webinarCommision; } else { echo 100 - $editRatio['webinarCommision']; } ?>" />
                                <?php if(isset($ratioError)) { echo $ratioError; } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Courses</strong> </label>
                            <div class="col-lg-2">
                                <input type="number" id="coursesCommisionId" class="form-control" value="<?php if(isset($coursesCommision)) { echo $coursesCommision; } else { echo $editRatio['coursesCommision']; } ?>"  name="coursesCommision"  placeholder="Set Ratio" />
                                </div><div class="col-lg-2">
                                <input type="number" id="coursesCommisionId2" readonly class="form-control" value="<?php if(isset($coursesCommision)) { echo 100 - $coursesCommision; } else { echo 100 - $editRatio['coursesCommision']; } ?>" />
                                <?php if(isset($ratioError)) { echo $ratioError; } ?>
                            </div>
                        </div>
  
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								<button type="submit" name="save" class="btn btn-primary cebutton mr-2">Save</button>
								<!-- <button onClick="window.location.href='..//';" type="button"  class="btn btn-secondary">Cancel</button> -->
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
    jQuery.validator.addMethod('number_rule', function(value, element) {
                if (value>=20 && value<=80) {
                    return true;
                } else {
                    return false;
                };
            });
    $('#myForm').validate({
			rules: {
                
				rocCommision:{
					required: true,
                    number_rule:true,
				},
                webinarCommision:{
					required: true,
                    number_rule:true,
				},
                coursesCommision:{
					required: true,
                    number_rule:true,
				},
				
			},
			messages: {
                
				rocCommision:{
					required: "Enter Ratio",
                    number_rule:"Enter valid Ratio 20-80",
				},
                webinarCommision:{
					required: "Enter Ratio",
                    number_rule:"Enter valid Ratio 20-80",
                    
				},
                coursesCommision:{
					required: "Enter Ratio",
                    number_rule:"Enter valid Ratio 20-80",
				},

			},
			

			// 	errorPlacement: function(error, element) { // render error placement for each input type
            //     if (element.attr('name') == 'cuisinesname') {
            //         error.appendTo("#cuisinesNameError");
            //     } else if (element.attr('name') == 'duration') {
            //         error.appendTo("#durationError");
            //     }  else {
            //         error.insertAfter(element);
            //     }
		    // }

		 })

    // display toastr on success
    <?php if(isset($_SESSION['editSuccess'])) { ?>
	
        toastr.success("Update Successfully");

    <?php unset($_SESSION['editSuccess']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../setratio/';
	
	<?php } ?>
    $(document).ready(function(){
    $("#rocCommisionId").on('change', function postinput(){
        var matchvalue = $(this).val(); // this.value
        var newval = 100 - matchvalue;
       
        $("#rocCommisionId2").val(newval);
    });
    $("#webinarCommisionId").on('change', function postinput(){
        var matchvalue = $(this).val(); // this.value
        var newval = 100 - matchvalue;
        
        $("#webinarCommisionId2").val(newval);
    });
    $("#coursesCommisionId").on('change', function postinput(){
        var matchvalue = $(this).val(); // this.value
        var newval = 100 - matchvalue; // 
        
        $("#coursesCommisionId2").val(newval);
    });
}); 
</script>