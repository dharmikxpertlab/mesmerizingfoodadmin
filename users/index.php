<?php
$categary = "userapp";
$pagename = "Users";
include "../include/header.php";
?>
<div class="container">
    <div class="row">
        
        <div class="col">
            <div class="form-group">
                <label for="exampleSelect1">Country<span class="text-danger"></span></label>
                <select class="form-control" style="width:100%" id="countryFiler" name="countryId" onchange="filterchange(this)">
                    <option value="">Select Country</option>
                    <?php $religionQuery = mysqli_query($connection, "SELECT DISTINCT(country) AS country FROM `user` WHERE `delete`=0");
                    while($row = mysqli_fetch_array($religionQuery)) {
                    ?>
                        <option value="<?php echo $row['country']; ?>"><?php echo $row['country']; ?></option>
                    <?php } ?>
                </select>
                <div id="selecttag"></div>
            </div>
        </div>
        <div class="col">
            
            <div class="form-group">
                <?php    $rel = mysqli_query($connection,"SELECT DISTINCT(state) AS state FROM `user` WHERE state !='' And `delete`= '0' ");
                ?>
                <label for="exampleSelect1">State<span class="text-danger"></span></label>
                <select class="form-control" style="width:100%" id="StateFilter" name="religionId" onchange="statefilterchange(this)">
                    <option value="">Select State</option>
                    
                    <?php 
                  
                  if(mysqli_num_rows($rel) > 0){
                    while($row = mysqli_fetch_array($rel)) {     
                                          
                    ?>                       
                        <option value="<?php echo $row['state']; ?>"><?php echo $row['state']; ?></option>
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
                <select class="form-control" style="width:100%" id="cityFilter" name="religionId" onchange="cityfilterchange(this)">
                    <option value="">Select City</option>
                    <?php $religionQuery = mysqli_query($connection, "SELECT DISTINCT(city) AS city FROM `user` WHERE city !='' And `delete`= '0' ");
                    while($row = mysqli_fetch_array($religionQuery)) {
                    ?>
                        <option value="<?php echo $row['city']; ?>"><?php echo $row['city'];?></option>
                    <?php } ?>
                </select>
                <div id="selecttag"></div>
            </div>
        </div>
     
    </div>

</div>
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
                    <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">View Users </span>
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
                    <th>Action</th>
                    <!-- <th>user Id</th> -->
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Mobile Number</th>
                    <th>Date Of Birth</th>
                    <th>Gender</th>
                    <th>Country</th>
                    <th>state</th>
                    <th>City</th>
                    
                    <!-- <th>Languages</th> -->
                   
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

// filter for country 
function filterchange(country)
	{
        // get value
        var con = country.value;

		$('#userDatatable').DataTable({
		destroy:true,
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../serverresponse/user.php?country="+con
		});
	}
    
// filter for state 
function statefilterchange(state)
	{
        // get value
        var con = state.value;

		$('#userDatatable').DataTable({
		destroy:true,
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../serverresponse/user.php?state="+con
		});
        
	}

    // filter for city 
function cityfilterchange(city)
	{
        // get value
        var cityName = city.value;

		$('#userDatatable').DataTable({
		destroy:true,
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../serverresponse/user.php?city="+cityName
		});
	}
    //TABLE
	$('#userDatatable').DataTable({
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../serverresponse/user.php"
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
