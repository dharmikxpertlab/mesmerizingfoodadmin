<?php
$categary = "Master";
$pagename = isset($_GET['edit']) ? "Edit Sub Category" : "Add Sub Category";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editDishes=mysqli_fetch_array(mysqli_query($connection,"select * from `dishes` where `dishId` = '$id'"));
        $cuisineId=$editDishes['cuisineId'];
	}
    
    // $cuisine = mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$cuisineId'"));

    //ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
        $cuisinesname = trim($_POST['cuisinesname']);
        $dishname = trim($_POST['dishname']);
        
        if($cuisinesname==""){
            $nameError="<div class='error'>Category Required</div>";
			$flag=0;
        }
        if($dishname==""){
            $dishnameError="<div class='error'>Sub Category Required</div>";
			$flag=0;
        }else if(mysqli_num_rows(mysqli_query($connection,"select * from `dishes` where `dishName` = '$dishname' and `delete` = '0'"))>0)
		{
			if(!isset($_GET['edit'])) 
			{
				$dishnameError="<div class='error'>Sub Category Exists</div>";
				$flag=0;
			}
			else if($editDishes['dishName']!=$dishname)
			{
				$dishnameError="<div class='error'>Sub Category Exists</div>";
				$flag=0;
			}	
		}
        
        
        
        
        
        
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				mysqli_query($connection,"UPDATE `dishes` SET `cuisineId` = '$cuisinesname',`dishName` = '$dishname' where `dishId` = '$id'") or die(mysqli_error($connection));
				
				$editSuccess=1;
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `dishes` SET `cuisineId` = '$cuisinesname',`dishName` = '$dishname'") or die(mysqli_error($connection));
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
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Category</strong> </label>
                        <div class="col-lg-4">
                            <!-- <input type="text" class="form-control" value="<?php if(isset($cuisinesname)) { echo $cuisinesname; } else if(isset($_GET['edit'])) { echo $cuisine['cuisineName']; } ?>"  name="cuisinesname"  placeholder="Enter Name" /> -->
                        <select name="cuisinesname" id="cuisinesname" class="form-control">
                            <option value='' >Select Category</option>
                            <?php
                            
                            $result = mysqli_query($connection,"select * from `cuisines` where `delete` = 0");
                            while ($row = mysqli_fetch_assoc($result)) {
                                if($row['cuisineId']==$cuisineId){
                                    echo "<option value='$row[cuisineId]' selected>$row[cuisineName]</option>";
                                }else{
                                    echo "<option value='$row[cuisineId]'>$row[cuisineName]</option>";
                                }
                                
                            }
                            ?>
                            
                        </select>
                            <?php if(isset($nameError)) { echo $nameError; } ?>
                            <span id="cuisinesNameError"></span>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Sub Category</strong> </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?php if(isset($dishname)) { echo $dishname; } else if(isset($_GET['edit'])) { echo $editDishes['dishName']; } ?>"  name="dishname"  placeholder="Enter Name" />
                            <?php if(isset($dishnameError)) { echo $dishnameError; } ?>
                        </div>
                    </div>
						
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								<button onClick="window.location.href='../dishes/';" type="button"  class="btn btn-secondary">Cancel</button>
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
    
$('#myForm').validate({
			rules: {
                cuisinesname:{
                    required: true,
                },
				dishname:{
					required: true,
                    name_rule:true,
				},
				
				
			},
			messages: {
                cuisinesname:{
                    required: "Select Cuisines",
                },
				dishname:{
					required: "Enter Dish Name",
                    name_rule:"Enter Valid Dish Name",
				},
				
				
			},
			

				errorPlacement: function(error, element) { // render error placement for each input type
                if (element.attr('name') == 'cuisinesname') {
                    error.appendTo("#cuisinesNameError");
                } else if (element.attr('name') == 'duration') {
                    error.appendTo("#durationError");
                }  else {
                    error.insertAfter(element);
                }
		    }


		 })

    $('#cuisinesname').select2({
        selectOnClose: true
    });
    // display toastr on success
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success("Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../adddishes/';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../dishes/';
	
	<?php } ?>
</script>