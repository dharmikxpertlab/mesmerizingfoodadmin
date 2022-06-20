<?php
$categary = "Setting";
$pagename = "Set Withdraw Criteria";

include "../include/header.php";


//EDIT DETAIL

    $editRatio=mysqli_fetch_array(mysqli_query($connection,"select * from `setting` where `settingId` = '1'"));

    // $cuisine = mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$cuisineId'"));

    //ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
        $minimumdays = trim($_POST['minimumdays']);
        $minimumcoins = trim($_POST['minimumcoins']);

        if($minimumdays==""){
            $minimumdaysError="<div class='error'>Minimum Day Required</div>";
			$flag=0;
        }

        if($minimumcoins==""){
            $minimumcoinsError="<div class='error'>Minimum Coins Required</div>";
			$flag=0;
        }
      
        if($flag == 1)
		{
			
				mysqli_query($connection,"UPDATE `setting` SET `minimumWithdrawAmount` = '$minimumcoins',`minimumWithdrawDay`='$minimumdays' where `settingId` = '1'") or die(mysqli_error($connection));
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
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Minimum Days</strong> </label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php if(isset($minimumdays)) { echo $minimumdays; } else { echo $editRatio['minimumWithdrawDay']; } ?>"  name="minimumdays"  placeholder="Minimum Days" />
                                <?php if(isset($minimumdaysError)) { echo $minimumdaysError; } ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Minimum Coins</strong> </label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php if(isset($minimumcoins)) { echo $minimumcoins; } else { echo $editRatio['minimumWithdrawAmount']; } ?>"  name="minimumcoins"  placeholder="Minimum Coins" />
                                <?php if(isset($minimumcoinsError)) { echo $minimumcoinsError; } ?>
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
            jQuery.validator.addMethod('days_rule', function(value, element) {
                if (value<=15) {
                    return true;
                } else {
                    return false;
                };
            });
            jQuery.validator.addMethod('coins_rule', function(value, element) {
                if (value>=300) {
                    return true;
                } else {
                    return false;
                };
            });
   $('#myForm').validate({
			rules: {
                
				minimumdays:{
					required: true,
                    number:true,
                    days_rule:true
				},
                minimumcoins:{
                    required: true,
                    number:true,
                    coins_rule:true,
                    maxlength:4,
                }
				
			},
			messages: {
                
				minimumdays:{
					required: "Enter Minimum Days",
                    number_rule:"Days between 0-15"               
				},
                minimumcoins:{
                    required: "Enter Minimum Coins",
                    coins_rule:"Minimum Coins is 300",

                }

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
		
		 window.location.href='..//';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../withdrawcriteria/';
	
	<?php } ?>
</script>