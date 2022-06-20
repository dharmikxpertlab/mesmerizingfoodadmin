<?php
$categary = "userapp";
$pagename = "Call Running";
include "../include/header.php";
?>
<!-- <div class="container">
    <div class="row">
        
        <div class="col">
            <div class="form-group">
                <label for="exampleSelect1">Rejected<span class="text-danger"></span></label>
                <select class="form-control" style="width:100%" id="countryFiler" name="countryId">
                    <option value="">Select Country</option>
                    <?php $religionQuery = mysqli_query($connection, "SELECT * FROM `country` WHERE `delete`=0");
                    while($row = mysqli_fetch_array($religionQuery)) {
                    ?>
                        <option value="<?php echo $row['countryId']; ?>"><?php echo $row['countryName']; ?></option>
                    <?php } ?>
                </select>
                <div id="selecttag"></div>
            </div>
        </div>
        <div class="col">
            
            <div class="form-group">
                <?php    $rel = mysqli_query($connection,"SELECT * FROM `state` WHERE `delete`= '0'");
                ?>
                <label for="exampleSelect1">State<span class="text-danger"></span></label>
                <select class="form-control" style="width:100%" id="StateFilter" name="religionId">
                    <option value="">Select State</option>
                    
                    <?php 
                  
                  if(mysqli_num_rows($rel) > 0){
                    while($row = mysqli_fetch_array($rel)) {     
                                          
                    ?>                       
                        <option value="<?php echo $row['stateId']; ?>"><?php echo $row['stateName']; ?></option>
                    <?php }}else{
                       echo "<option>Select State</option>";
                    }
                    ?>
                </select>
                <div id="selecttag"></div>
            </div>
        </div>
      
        <div class="col">
            <div class="form-group">
                <label for="exampleSelect1">City<span class="text-danger"></span></label>
                <select class="form-control" style="width:100%" id="cityFilter" name="religionId">
                    <option value="">Select City</option>
                    <?php $religionQuery = mysqli_query($connection, "SELECT * FROM `city` WHERE `delete`=0");
                    while($row = mysqli_fetch_array($religionQuery)) {
                    ?>
                        <option value="<?php echo $row['cityId']; ?>"><?php echo $row['cityName']; ?></option>
                    <?php } ?>
                </select>
                <div id="selecttag"></div>
            </div>
        </div>
     
    </div>

</div> -->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- begin::Subheader -->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo $pagename; ?></h5>
                <!--end::Title-->
                <!--begin::Separator-->
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                <!--end::Separator-->
                <!--begin::Search Form-->
                <div class="d-flex align-items-center" id="kt_subheader_search">
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"> </span>
                </div>
                <!--end::Search Form-->
            </div>
            <!--end::Details-->
           
        </div>
    </div>
    <!--end::Subheader-->


<!--begin::Cardaaa-->
<div class="card card-custom gutter-b">


    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="userDatatable">
            <thead>
                <tr>
                    <th>#</th>
                   
                   
                    <th>User Name</th>
                    <th>Chef Name</th>
                    <th>Call type</th>
                    
                   
                </tr>
            </thead>
            <tbody>
                

            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->

</div>
<?php
include "../include/footer.php";
?>
<script>
    //TABLE
	$('#userDatatable').DataTable({
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../serverresponse/runningcall.php"
	});

    function remove(id)
   {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't delete this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: 'No, Cancel!',
		reverseButtons: true
    }).then(function(result) {
        if (result.value) {
        $.ajax({  

         type:"POST",  
         url:"../ajax/userdelete.php",  
         data:"id="+id,  
         success:function(data){  
            if (data == 'delete') {
            Swal.fire(
                "Deleted!",
                "Your file has been deleted.",
                "success",
                
            )
            setTimeout("location.reload(true);", 600);
            }
            
         }  
        
        }); 
    }
        
    });

   }    
    
</script>
