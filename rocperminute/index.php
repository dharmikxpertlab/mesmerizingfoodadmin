<?php
$categary = "Setting";
$pagename = "ROC-Per minute" ;
$id = "1";
include "../include/header.php";


//EDIT DETAIL

		$roc=mysqli_fetch_array(mysqli_query($connection,"select * from `setting` where `settingId` = '1'"));
        

    
    // $cuisine = mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$cuisineId'"));

    //ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
     


        // $course = trim($_POST['course']);
        $rocperminute=$_POST['rocperminute'];
        
       
        
        if($rocperminute==""){
            $rocperminuteError="<div class='error'>ROC-Per minute Required</div>";
			$flag=0;
        }
        
        
        
        if($flag == 1)
		{
			
				mysqli_query($connection,"UPDATE `setting` SET `rocPerMinute` = '$rocperminute' where `settingId` = '1'") or die(mysqli_error($connection));
				
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
					<h3 class="card-title">Rate On Call - Per Minute</h3>
				</div>
				<!--begin::Form-->
				<form class="form" method="post" id="myForm" enctype="multipart/form-data">
					<div class="card-body">

                    <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>ROC-Per minute</strong> </label>
							<div class="col-lg-4">
							<div class="input-group">
                            
                                <input type="text" class="form-control" value="<?php if(isset($rocperminute)) { echo $rocperminute; } else { echo $roc['rocPerMinute']; } ?>"  name="rocperminute"   />
							
								<div class="input-group-append"><span class="input-group-text" >Coins</span></div>
								
							</div>
							<span id="amountError"></span>
							<?php if(isset($rocperminuteError)) { echo $rocperminuteError; } ?>
							</div>
						</div>
                        <!-- <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>ROC-Per minute</strong> </label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php if(isset($rocperminute)) { echo $rocperminute; } else { echo $roc['rocPerMinute']; } ?>"  name="rocperminute"   />
                                <?php if(isset($rocperminuteError)) { echo $rocperminuteError; } ?>
                            </div>
                        </div> -->
                    
						
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								<button type="submit" name="save" class="btn btn-primary cebutton mr-2">Save</button>
								<!-- <button onClick="window.location.href='../courseprice/';" type="button"  class="btn btn-secondary">Cancel</button> -->
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
       
       $('#myForm').validate({
			rules: {
                
				rocperminute:{
					required: true,
                    number:true,
                    
				},
               
				
			},
			messages: {
                
				rocperminute:{
					required: "Enter roc-per minute",
                    number_rule:"Days between 0-15"               
				},
                

			},
			

				errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr('name') == 'rocperminute') {
                    error.appendTo("#amountError");
                } else if (element.attr('name') == 'duration') {
                    error.appendTo("#durationError");
                }  else {
                    error.insertAfter(element);
                }
		    }

		 })
    
    // display toastr on success
    <?php if(isset($_SESSION['editSuccess'])) { ?>
	
        toastr.success("Update Successfully");

    <?php unset($_SESSION['editSuccess']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='..//';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../rocperminute/';
	
	<?php } ?>
</script>