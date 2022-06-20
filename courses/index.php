<?php
$categary = "Master";
$pagename = "courses";
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
        <table class="table table-separate table-head-custom table-checkable" id="curousalDatatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Course Name</th> 
                    <th>Description</th> 
                    <th>category</th>
                    <th>duration</th>
                    <th>language</th>
                    <th>price</th>
                    <th>cover Image</th>
                    
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
    // TABLE
	$('#curousalDatatable').DataTable({
		scrollY: '50vh',
		scrollX: true,
		scrollCollapse: true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "../serverresponse/courses.php"
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
         url:"../ajax/deletecourses.php",  
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
