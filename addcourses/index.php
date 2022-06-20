<?php
$categary = "Master";
$pagename = isset($_GET['edit']) ? "Edit Course" : "Add Course";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editCourse=mysqli_fetch_array(mysqli_query($connection,"select * from `course` where `courseId` = '$id'"));
        $categoryId=$editCourse['category'];
        $languageId=$editCourse['languageId'];
        $oldImage = $editCourse['coverImage'];
        $oldvideo = $editCourse['courseVideo'];
        $subCategory = $editCourse['subCategory'];
	}
    
    // $cuisine = mysqli_fetch_array(mysqli_query($connection,"select * from `cuisines` where `cuisineId` = '$cuisineId'"));

    //ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
     


        $course = ucfirst(trim($_POST['course']));
        $description =trim($_POST['description']);
        $cuisines = $_POST['cuisines'];
        $subCategory = $_POST['subCategory'];
        $duration = $_POST['duration'];
        $language = $_POST['language'];
        $price =$_POST['price'];
        
        if($course==""){
            $nameError="<div class='error'>Course Name Required</div>";
			$flag=0;
        }
        if($description==""){
            $descriptionError="<div class='error'>Description Required</div>";
			$flag=0;
        }
        if($cuisines==""){
            $cuisinesError="<div class='error'>Category Required</div>";
			$flag=0;
        }
        if($duration==""){
            $durationError="<div class='error'>Duration Required</div>";
			$flag=0;
        }
        if($language==""){
            $languageError="<div class='error'>Language Required</div>";
			$flag=0;
        }
        if($price==""){
            $priceError="<div class='error'>Price Required</div>";
			$flag=0;
        }
      
        $imagefiles =strtolower(trim($_FILES['coverImage']['name']));
        $imageTmpLoc = $_FILES["coverImage"]["tmp_name"]; // File in the PHP tmp folder
        $imageType = $_FILES["coverImage"]["type"]; // The type of file it is
        $imagefileSize = $_FILES["coverImage"]["size"]; // File size in bytes
        $imagepath = "../images/courses/";
        $imagetargetfile = $imagepath . basename($imagefiles); 
        $imagefiletype = pathinfo($imagetargetfile,PATHINFO_EXTENSION);
        $imagekaboom = explode(".", $imagefiles); // Split file name into an array using the dot
        $imagefileExt = end($imagekaboom); // Now target the last array element to get the file extension
        $imagedate = date("Y-m-d H:i:s");
        $imagetimestamp = strtotime($imagedate);
        $driverimage = 'courses'. '-'.$imagetimestamp.'.'. $imagefileExt;
        if($imagefileExt=="" ){
            // if for not changing image in course 
            if(!isset($_GET['edit'])){
                $coverImageError = "<div class='error'>Select Image</div>";
                $flag=0;
            }else{
                $driverimage = $oldImage;
            }
        }else{

            if(isset($_GET['edit'])){
                // upload Image if change 
                move_uploaded_file($imageTmpLoc,$imagepath. $driverimage);
                unlink($imagepath.$oldImage);
                // echo $imagepath.$oldImage;
            }else{

                move_uploaded_file($imageTmpLoc,$imagepath. $driverimage);
            }
        }
               
        // unlink($path,$imgname);
        
        $videofiles =strtolower(trim($_FILES['courseVideo']['name']));
        $videoTmpLoc = $_FILES["courseVideo"]["tmp_name"]; // File in the PHP tmp folder
        $videoType = $_FILES["courseVideo"]["type"]; // The type of file it is
        $videofileSize = $_FILES["courseVideo"]["size"]; // File size in bytes
        $videopath = "../video/courses/";
        $videotargetfile = $videopath . basename($videofiles); 
        $videofiletype = pathinfo($videotargetfile,PATHINFO_EXTENSION);
        $videokaboom = explode(".", $videofiles); // Split file name into an array using the dot
        $videofileExt = end($videokaboom); // Now target the last array element to get the file extension
        $videodate = date("Y-m-d H:i:s");
        $videotimestamp = strtotime($videodate);
        $courseVideo = 'coursesVideo'. '-'.$videotimestamp.'.'. $videofileExt;
        if($videofileExt=="" ){
            // if for not changing video in course 
            if(!isset($_GET['edit'])){
                $videoError = "<div class='error'>Select Video</div>";
                $flag=0;
            }else{
                $courseVideo = $oldvideo;
            }
        }else{
            if(isset($_GET['edit'])){
                // upload Video if change 
                move_uploaded_file($videoTmpLoc,$videopath.$courseVideo);
                unlink($videopath.$oldvideo);
                // echo $imagepath.$oldImage;
            }else{
                move_uploaded_file($videoTmpLoc,$videopath.$courseVideo);
            }
        }
        
 
        
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				mysqli_query($connection,"UPDATE `course` SET 
                `name` = '$course',
                `description` = '$description',
                `category` = '$cuisines',
                `subCategory` = '$subCategory',
                `duration` = '$duration',
                `languageId` = '$language',
                `price`='$price',
                `coverImage`='$driverimage',
                `courseVideo`='$courseVideo' 
                where `courseId` = '$id'") or die(mysqli_error($connection));
				
				$editSuccess=1;
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `course` SET
                `name` = '$course',
                `description` = '$description',
                `category` = '$cuisines',
                `subCategory` = '$subCategory',
                `duration` = '$duration',
                `languageId` = '$language',
                `price`='$price',
                `coverImage`='$driverimage',
                `courseVideo`='$courseVideo' 
                ") or die(mysqli_error($connection));
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
                            <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Course Name</strong> </label>
                            <div class="col-lg-4">
                                <input type="text" class="form-control" value="<?php if(isset($course)) { echo $course; } else if(isset($_GET['edit'])) { echo $editCourse['name']; } ?>"  name="course"  placeholder="Enter Course Name" />
                                <?php if(isset($nameError)) { echo $nameError; } ?>
                            </div>
                        </div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Description</strong> </label>
							<div class="col-lg-4">
								<textarea class="form-control" name="description"  placeholder="Enter description"><?php if(isset($description)) { echo $description; } else if(isset($_GET['edit'])) { echo $editCourse['description']; } ?></textarea>
								<!-- <input type="text" class="form-control" value="<?php if(isset($description)) { echo $description; } else if(isset($_GET['edit'])) { echo $editCourse['description']; } ?>"  name="description"  placeholder="Enter description" /> -->
								<?php if(isset($descriptionError)) { echo $descriptionError; } ?>
							</div>
						</div> 
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Select Category</strong> </label>
                        
                        <div class="col-lg-4">
                                <!-- <input type="text" class="form-control" value="<?php if(isset($cuisinesname)) { echo $cuisinesname; } else if(isset($_GET['edit'])) { echo $cuisine['cuisineName']; } ?>"  name="cuisinesname"  placeholder="Enter Name" /> -->
                            <select name="cuisines" id="cuisines" class="form-control" onchange="getsubCategory()">
                            <option value='' >Select Category</option>
                                <?php
                                
                                $result = mysqli_query($connection,"select * from `cuisines` where `delete` = 0");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['cuisineId']==$categoryId){
                                        echo "<option value='$row[cuisineId]' selected>$row[cuisineName]</option>";
                                    }else{
                                        echo "<option value='$row[cuisineId]'>$row[cuisineName]</option>";
                                    }
                                    
                                }
                                ?>
                                
                            </select>
                            <?php if(isset($cuisinesError)) { echo $cuisinesError; } ?>
                            <span id="cuisinesError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Select SubCategory</strong> </label>
                        
                        <div class="col-lg-4">
                               
                            <select name="subCategory" id="subCategory" class="form-control">
                            <option value='' >Select SubCategory</option>
                                <?php
                                
                                $result = mysqli_query($connection,"select * from `dishes` where `delete` = 0 AND  `cuisineId` = $categoryId");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['dishId']==$subCategory){
                                        echo "<option value='$row[dishId]' selected>$row[dishName]</option>";
                                    }else{
                                        echo "<option value='$row[dishId]'>$row[dishName]</option>";
                                    }
                                    
                                }
                                ?>
                                
                            </select>
                            <?php if(isset($cuisinesError)) { echo $cuisinesError; } ?>
                            <span id="subCategoryError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Duration</strong> </label>
							<div class="col-lg-4">
							<div class="input-group">
								<input type="text" class="form-control" value="<?php if(isset($duration)) { echo $duration; } else if(isset($_GET['edit'])) { echo $editCourse['duration']; } ?>"  name="duration"  placeholder="Enter Duration" />
								<div class="input-group-append"><span class="input-group-text" >Hour</span></div>
								
							</div>
							<span id="durationError"></span>
							<?php if(isset($durationError)) { echo $durationError; } ?>
							</div>
						</div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Language</strong> </label>
                        
                        <div class="col-lg-4">
                                <!-- <input type="text" class="form-control" value="<?php if(isset($cuisinesname)) { echo $cuisinesname; } else if(isset($_GET['edit'])) { echo $cuisine['cuisineName']; } ?>"  name="cuisinesname"  placeholder="Enter Name" /> -->
                            <select name="language" id="language" class="form-control">
                            <option value=''>Select Language</option>
                                <?php
                                
                                $result = mysqli_query($connection,"select * from `language` where `delete` = 0");
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if($row['languageId']==$languageId){
                                        echo "<option value='$row[languageId]' selected>$row[name]</option>";
                                    }else{
                                        echo "<option value='$row[languageId]'>$row[name]</option>";
                                    }
                                    
                                }
                                ?>
                                
                            </select>
                            <?php if(isset($languageError)) { echo $languageError; } ?>
                            <span id="languageError"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>price</strong> </label>
                        <div class="col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php if(isset($price)) { echo $price; } else if(isset($_GET['edit'])) { echo $editCourse['price']; } ?>"  name="price"  placeholder="Enter price" />
                            <div class="input-group-append"><span class="input-group-text" >Coins</span></div>
                        </div>
                        <span id="priceError"></span>
                            <?php if(isset($priceError)) { echo $priceError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Select Cover Image</strong> </label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control"  name="coverImage"  />
                            <?php if(isset($coverImageError)) { echo $coverImageError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Select Video</strong> </label>
                        <div class="col-lg-4">
                            <input type="file" class="form-control"  name="courseVideo"  />
                            <?php if(isset($videoError)) { echo $videoError; } ?>
                        </div>
                    </div>
						
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								
								<button onClick="window.location.href='../courses/';" type="button"  class="btn btn-secondary">Cancel</button>
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
    // get state in selece2 acording to contry selected
    function getsubCategory() {
        var categoryId = $("#cuisines").val();
        $.post("../ajax/selectajax.php",{getsubCategory:'getsubCategory',categoryId:categoryId},function (response) {
            var data = response.split('^');
            $("#subCategory").html(data[1]);
        });
    }

            jQuery.validator.addMethod('number_rule', function(value, element) {
                if (/^\(?([0-9])\)?$/.test(value)) {
                    return true;
                } else {
                    return false;
                };
            });
			jQuery.validator.addMethod('duration_rule', function(value, element) {
                if (/^([01]?[0-9]|2[0-3])$/.test(value)) {
                    return true;
                } else {
                    return false;
                };
            });


        // validation
        $('#myForm').validate({
			rules: {
				course:{
					required: true,
				},
				description:{
					required: true,
				},
                cuisines:{
                    required: true,
                },
				subCategory:{
                    required: true,
                },
				duration:{
					required: true,
					duration_rule: true,
				},
				language:{
					required: true,
					
				},
                price:{
					required: true,
                    number: true,
					maxlength:6,
				},
				coverImage:{
					<?php if(!isset($_GET['edit'])){ 
                        
                        echo"required: true";

                     }?>					
				},
                courseVideo:{
                    <?php if(!isset($_GET['edit'])){ 
                        
                        echo"required: true";

                     }?>	
                }
				
				
			},
			messages: {
				course:{
					required: "Enter Course Name",
				},
				description:{
					required: "Enter Description",
				},
                cuisines:{
                    required: "Select Category",
                },
                subCategory:{
                    required: "Select Sub Category",
                },
				price:{
					required: "Enter Price",
                    number_rule:"Enter valid Price"
                    
				},
				duration:{
					required: "Enter Duration",
					duration_rule:"Enter valid hour"
				},
				language:{
					required: "Select Language",
				},
				coverImage:{
					required: "Select Image",
				},
                courseVideo:{
					required: "Select Video",
				},
                
				
			},
			// errorPlacement: function(error, element) {
            //         if (element.is("amount")) {
            //             error.appendTo($('#amountError'));
            //         }
            //     },

			errorPlacement: function(error, element) { // render error placement for each input type
			if (element.attr('name') == 'cuisines') {
				error.appendTo("#cuisinesError");
			} else if (element.attr('name') == 'duration') {
				error.appendTo("#durationError");
			} else if (element.attr('name') == 'language') {
				error.appendTo("#languageError");
			} else if (element.attr('name') == 'price') {
				error.appendTo("#priceError");
			}else if (element.attr('name') == 'subCategory') {
				error.appendTo("#subCategoryError");
			} else {
				error.insertAfter(element);
			}
		}


		 })
    $('#language').select2({
        selectOnClose: true
    });
    $('#cuisines').select2({
        selectOnClose: true
    });
    $('#subCategory').select2({
        selectOnClose: true
    });
    // display toastr on success
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success("Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../addcourses/';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../courses/';
	
	<?php } ?>
</script>