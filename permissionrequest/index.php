<?php
$categary = "Tutor App";
$pagename = "Permission Request";
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
                    <th>status</th>
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

<!-- Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reason for Denied</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form>
            <div class="modal-body">
            <div class="form-group ">
                
                <label class="" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Reason</strong> </label>
                <div class="">
                    <input type="text" class="form-control" value="" id="reason"  name="course"  placeholder="Enter Reason" />
                    <!-- <?php if(isset($nameError)) { echo $nameError; } ?> -->
                </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                
            </div>
            </form>
        </div>
    </div>
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
		"sAjaxSource": "../serverresponse/tutorsrequest.php"
	});

    
    function approve(id)
   {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't Approve this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Approve it!",
        cancelButtonText: 'No, Cancel!',
		reverseButtons: true
    }).then(function(result) {
        if (result.value) {
        $.ajax({  

         type:"POST",  
         url:"../ajax/tutorsapprove.php",  
         data:"id="+id,  
         success:function(data){  
            if (data == 'approve') {
            Swal.fire(
                "Approve!",
                "success",  
            )
            setTimeout("location.reload(true);", 600);
            }
            
         }  
        
        }); 
    }
        
    });

   }
   function reason(id){
    $('#exampleModal').modal('show');
    $(".modal-body").append('<input type="hidden" id="chefid" value="'+id+'" class="form-control" name="Id">');
    $(".modal-footer").append('<button type="button" onclick="denied('+id+')" class="btn btn-primary font-weight-bold">Save changes</button>');

   }  
   function denied(id)
   {
    var reason123 = $("#reason").val();
    // var chefId = $("#chefid").val();
    // alert(reason123);
    // alert(id);
    

    Swal.fire({
        title: "Are you sure?",
        text: "You won't Denied this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, Denied it!",
        cancelButtonText: 'No, Cancel!',
		reverseButtons: true
    }).then(function(result) {
        if (result.value) {
        $.ajax({  

         type:"POST",  
         url:"../ajax/tutorsdenied.php",  
         data:"id="+id+"&reason="+reason123, 
            //  id=id,
            //  reason = reason123,
         

         success:function(data){  
            if (data == 'denied') {
            Swal.fire(
                "denied!",
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
