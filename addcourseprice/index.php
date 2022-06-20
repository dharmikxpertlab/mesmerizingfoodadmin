<?php
$categary = "Master";
$pagename = isset($_GET['edit']) ? "Edit Course Price" : "Add Course";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editCourse=mysqli_fetch_array(mysqli_query($connection,"select * from `course` where `courseId` = '$id'"));
        $categoryId=$editCourse['category'];
        $languageId=$editCourse['languageId'];
	}
    
    // $cuisine = mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$cuisineId'"));

    //ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
     


        $course = trim($_POST['course']);
        $price =$_POST['price'];
        
        if($course==""){
            $nameError="<div class='error'>Course Name Required</div>";
			$flag=0;
        }
        
        if($price==""){
            $priceError="<div class='error'>Price Required</div>";
			$flag=0;
        }
        
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				mysqli_query($connection,"UPDATE `course` SET `name` = '$course',`price`='$price' where `courseId` = '$id'") or die(mysqli_error($connection));
				
				$editSuccess=1;
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
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Course Name</strong> </label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php if(isset($course)) { echo $course; } else if(isset($_GET['edit'])) { echo $editCourse['name']; } ?>"  name="course"  placeholder="Enter Course Name" />
                                <?php if(isset($nameError)) { echo $nameError; } ?>
                            </div>
                        </div>
                        

                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Price</strong> </label>
							<div class="col-lg-4">
							<div class="input-group">
								<input type="text" class="form-control" value="<?php if(isset($price)) { echo $price; } else if(isset($_GET['edit'])) { echo $editCourse['price']; } ?>"  name="price"  placeholder="Enter price" />

								
								<!-- <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon2"/> -->
								<div class="input-group-append"><span class="input-group-text" >Coins</span></div>
								
							</div>
							<span id="amountError"></span>
							<?php if(isset($priceError)) { echo $priceError; } ?>
							</div>
						</div>

                        <!-- <div class="form-group row">
                            <div class="col-lg-2"></div>
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>price</strong> </label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php if(isset($price)) { echo $price; } else if(isset($_GET['edit'])) { echo $editCourse['price']; } ?>"  name="price"  placeholder="Enter price" />
                                <?php if(isset($priceError)) { echo $priceError; } ?>
                            </div>
                        </div> -->
                    
						
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								
								<button onClick="window.location.href='../courseprice/';" type="button"  class="btn btn-secondary">Cancel</button>
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

            jQuery.validator.addMethod('days_rule', function(value, element) {
                if (value<=15) {
                    return true;
                } else {
                    return false;
                };
            });
            jQuery.validator.addMethod('coins_rule', function(value, element) {
                if (value>=50) {
                    return true;
                } else {
                    return false;
                };
            });
            $('#myForm').validate({
			rules: {
                
				course:{
					required: true,
                    
				},
                price:{
                    required: true,
                    number:true,
                    coins_rule:true,
                    maxlength:4,
                }
				
			},
			messages: {
				course:{
					required: "Enter Course Name",        
				},
                price:{
                    required: "Enter Price",
                    coins_rule:"Minimum Coins is 50",
                }

			},
			

				errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr('name') == 'price') {
                    error.appendTo("#amountError");
                } else if (element.attr('name') == 'duration') {
                    error.appendTo("#durationError");
                }  else {
                    error.insertAfter(element);
                }
		    }

		 })
    
    // display toastr on success
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success("Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='..//';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../courseprice/';
	
	<?php } ?>
</script>