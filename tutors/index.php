<?php
$categary = "Tutor App";
$pagename = "Tutors";
include "../include/header.php";




?>


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

<!--begin::Cardaaa-->
<div class="card card-custom gutter-b">


    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="userDatatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Actions</th>
                    <!-- <th>user Id</th> -->
                    <th>Full Name</th>
                    <th>Contact</th>
                    <!-- <th>Mobile Number</th> -->
                    <!-- <th>Date Of Birth</th> -->
                    <th>Location</th>
                    <th>course Type</th>
                    <th>experience</th>
                    <!-- <th>Gender</th>
                    <th>Languages</th> -->
                    
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
		"sAjaxSource": "../serverresponse/tutors.php"
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
         url:"../ajax/tutorsdelete.php",  
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
