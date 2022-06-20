<?php
$categary = "Tutor App";
$pagename = isset($_GET['edit']) ? "Edit Live webinar" : "Add Live webinar";
$save = isset($_GET['edit']) ? "Save Changes" : "Save";

$id = isset($_GET['edit']) ? base64_decode($_GET['edit']) : "";
include "../include/header.php";


//EDIT DETAIL
if(isset($_GET['edit']))
	{
		$editUser=mysqli_fetch_array(mysqli_query($connection,"select * from `cheflive` where `chefLiveId` = '$id'"));
		$languageId = $editUser['languageId'];	
		$chefId = $editUser['chefId'];
	}
    
	//ADD AND EDIT DETAIL
	if(isset($_POST['save']))
	{
		$flag=1;
		
        $title = ucfirst(trim($_POST['title']));
        $description = trim($_POST['description']);
        $amount = trim($_POST['amount']);
        $duration = $_POST['duration'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $languageId = $_POST['languageId'];
		$chefId = $_POST['chefId'];
		

		// PHP VALIDATION
		if($title=="")
		{
			$titleError="<div class='error'>Title Required</div>";
			$flag=0;
		}
        if($description=="")
		{
			$descriptionError="<div class='error'>Description Required</div>";
			$flag=0;
		}
        
        if($amount=="")
		{
			$amountError="<div class='error'>Amount Required</div>";
			$flag=0;
		}

        if($duration==""){
			$durationError="<div class='error'>Duration Required</div>";
            $flag=0;
        }
        if($date==""){
			$dateError="<div class='error'>Date Required</div>";
            $flag=0;
        }
		if($time==""){
			$timeError="<div class='error'>Time Required</div>";
            $flag=0;
        }
        
	
        if($flag == 1)
		{
			if(isset($_GET['edit']))
			{
				// echo "UPDATE `cheflive` SET `title` = '$title',`description` = '$description', `amount` = '$amount',`duration`='$duration',`date`='$date' ,`time`='$time',`languageId`= '$languageId' WHERE `chefLiveId` = '".$id."'";
				// exit;
				mysqli_query($connection,"UPDATE `cheflive` SET 
				`title` = '$title',
				`chefId` = '$chefId',
				`description` = '$description', 
				`amount` = '$amount',
				`duration`='$duration',
				`date`='$date',
				`time`='$time',
				`languageId`= '$languageId' 
				WHERE `chefLiveId` = '".$id."'") or die(mysqli_error($connection));

				
				$editSuccess=1;
			}
			else
			{
				mysqli_query($connection,"INSERT INTO `cheflive` SET 
				`title` = '$title',
				`chefId` = '$chefId',
				`description` = '$description', 
				`amount` = '$amount',
				`date`='$date' ,
				`time`='$time',
				`languageId`= '$languageId'
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
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Title</strong> </label>
							<div class="col-lg-4">
								<input type="text" class="form-control" value="<?php if(isset($title)) { echo $title; } else if(isset($_GET['edit'])) { echo $editUser['title']; } ?>"  name="title"  placeholder="Enter title" />
								<?php if(isset($titleError)) { echo $titleError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Description</strong> </label>
							<div class="col-lg-4">
								<textarea class="form-control" name="description"  placeholder="Enter description"><?php if(isset($description)) { echo $description; } else if(isset($_GET['edit'])) { echo $editUser['description']; } ?></textarea>
								<!-- <input type="text" class="form-control" value="<?php if(isset($description)) { echo $description; } else if(isset($_GET['edit'])) { echo $editUser['description']; } ?>"  name="description"  placeholder="Enter description" /> -->
								<?php if(isset($descriptionError)) { echo $descriptionError; } ?>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Shef</strong> </label>
							
							<div class="col-lg-4">
									
								<select name="chefId" id="chefIdselect" class="form-control">
								<option value=''>Select Shef</option>
									<?php
									
									$result = mysqli_query($connection,"select * from `chef`");
									while ($row = mysqli_fetch_assoc($result)) {
										if($row['chefId']==$chefId){
											echo "<option value='$row[chefId]' selected>$row[fullName]</option>";
										}else{
											echo "<option value='$row[chefId]'>$row[fullName]</option>";
										}
										
									}
									?>
									
								</select>
								<?php if(isset($cuisinesError)) { echo $cuisinesError; } ?>
							</div>
						</div>
                        
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Amount</strong> </label>
							<div class="col-lg-4">
							<div class="input-group">
								<input type="text" class="form-control" aria-describedby="basic-addon2" value="<?php if(isset($amount)) { echo $amount; } else if(isset($_GET['edit'])) { echo $editUser['amount']; } ?>"  name="amount"  placeholder="Enter Amount" />
								
								<!-- <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon2"/> -->
								<div class="input-group-append"><span class="input-group-text" >Coins</span></div>
								
							</div>
							<span id="amountError"></span>
							<?php if(isset($amountError)) { echo $amountError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Duration</strong> </label>
							<div class="col-lg-4">
							<div class="input-group">
								<input type="text" class="form-control" value="<?php if(isset($duration)) { echo $duration; } else if(isset($_GET['edit'])) { echo $editUser['duration']; } ?>"  name="duration"  placeholder="Enter Duration" />
								<div class="input-group-append"><span class="input-group-text" >Hour</span></div>
								
							</div>
							<span id="durationError"></span>
							<?php if(isset($durationError)) { echo $durationError; } ?>
							</div>
						</div>
                        
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Date Of webinar</strong> </label>
							<div class="col-lg-4">
								<input type="date" class="form-control" value="<?php if(isset($date)) { echo $date; } else if(isset($_GET['edit'])) { echo $editUser['date']; } ?>"  name="date"  max="<?php $time = new DateTime('now'); echo $time->modify('+30 days')->format('Y-m-d'); ?>" min="<?php $time = new DateTime('now'); echo $time->format('Y-m-d'); ?>"   />
								<?php if(isset($dateError)) { echo $dateError; } ?>
							</div>
						</div>
                        <div class="form-group row">
							<div class="col-lg-2"></div>
							<label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Time Of webinar</strong> </label>
							<div class="col-lg-4">
								<input type="time" class="form-control" value="<?php if(isset($date)) { echo $date; } else if(isset($_GET['edit'])) { echo $editUser['time']; } ?>"  name="time"    />
								<?php if(isset($timeError)) { echo $timeError; } ?>
							</div>
						</div>
                        <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Language</strong> </label>
                        
                        <div class="col-lg-4">
                                
                            <select name="languageId" id="cuisines" class="form-control">
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
                            <?php if(isset($cuisinesError)) { echo $cuisinesError; } ?>
                        </div>
                    </div>

					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-lg-12" style="text-align: center;">
								
								<button onClick="window.location.href='../viewlivewebinars/';" type="button"  class="btn btn-secondary">Cancel</button>
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
	$("#chefIdselect").select2();
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

$('#myForm').validate({
			rules: {
				title:{
					required: true,
				},
				description:{
					required: true,
				},
				amount:{
					required: true,
                    number: true,
					maxlength:6,
				},
				duration:{
					required: true,
					duration_rule: true,
				},
				date:{
					required: true,
					
				},
				time:{
					required: true,
					
				},
				languageId:{
					required: true,
					
				},
				
			},
			messages: {
				title:{
					required: "Enter Title",
				},
				description:{
					required: "Enter Description",
				},
				amount:{
					required: "Enter Amount",
                    
				},
				duration:{
					required: "Enter Duration",
					duration_rule:"Enter valid hour"

				},
				date:{
					required: "Select Date",
					
				},
				time:{
					required: "Select Time",
					
				},
				languageId:{
					required: "Select language",
					
				},
			},
			// errorPlacement: function(error, element) {
            //         if (element.is("amount")) {
            //             error.appendTo($('#amountError'));
            //         }
            //     },

				errorPlacement: function(error, element) { // render error placement for each input type
			if (element.attr('name') == 'amount') {
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
	
        toastr.success(" Added Successfully");

    <?php unset($_SESSION['success']); } ?>

    // set success session
	
	<?php if(isset($success)) {  $_SESSION['success']=1; ?>
		
		 window.location.href='../addlivewebinars/';
	
	<?php } else if(isset($editSuccess)) {  $_SESSION['editSuccess']=1; ?>
		
		 window.location.href='../viewlivewebinars/';
	
	<?php } ?>
</script>