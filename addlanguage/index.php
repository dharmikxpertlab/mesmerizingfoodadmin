<?php
$categary = "Master";
$pagename = isset($_GET['id']) ? "Edit Language" : "Add Language";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

include '../include/header.php';
$languageId = isset($_GET['id']) ? base64_decode($_GET['id']) : "";
if (isset($_GET['id'])) {
    $languageData = mysqli_fetch_array(mysqli_query($connection, "SELECt * FROM `language` WHERE `languageId`='" . $languageId . "'"));
    $name = $languageData['name'];
    
}



if (isset($_REQUEST['save'])) {
    $flag = 1;
    $name = $_REQUEST['name'];
    
    if($name==""){


    }
    else if(mysqli_num_rows(mysqli_query($connection,"select * from `language` where `name` = '$name' and `delete` = '0'"))>0)
    {
        if(!isset($_GET['id'])) 
        {
            $nameError="<div class='error'>Language Name Exists</div>";
            $flag=0;
        }
        else if($languageData['name']!=$name)
        {
            $nameError="<div class='error'>Language Name 4 Exists</div>";
            $flag=0;
        }	
    }
    if($flag == 1)
    {
        if(isset($_GET['id']))
        {
            mysqli_query($connection,"UPDATE `language` SET `name` = '$name' where `languageId` = '$languageId'") or die(mysqli_error($connection));
            
            $editSuccess=1;
        }
        else
        {
            mysqli_query($connection,"INSERT INTO `language` SET `name` = '$name'") or die(mysqli_error($connection));
            $success=1;
        }
    }
}
?>
<style>
    .error {
        color: red;
    }
</style>

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

                    <?php if (isset($existError)) {
                        echo $existError;
                    } ?>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Language Name</strong> </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?php if (isset($name)) {
                                                                                echo $name;
                                                                            } ?>" name="name" placeholder="Enter Language" />
                    <?php if(isset($nameError)) { echo $nameError; } ?>    
                    </div>
                        
                    </div>
                    

                </div>

                <div class="card-footer">

                    <div class="row">
                        <div class="col-lg-12" style="text-align: center;">
                            
                            <button onClick="window.location.href='../viewlanguage/';" type="button" class="btn btn-secondary">Cancel</button>
                            <button type="submit" name="save" class="btn btn-primary cebutton mr-2"><?php echo $save; ?></button>
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
include '../include/footer.php';
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
                
				name:{
					required: true,
                    name_rule:true,
				},
				
				
			},
			messages: {
                
				name:{
					required: "Enter Language Name",
                    name_rule:"Enter Valid Language Name",
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
    <?php if(isset($_SESSION['success'])) { ?>
	
        toastr.success("Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../addlanguage/';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../viewlanguage/';
	
	<?php } ?>
</script>