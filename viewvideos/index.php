<?php
$categary = "Master";
$pagename = "Offers";
include "../include/header.php";
?>



<!--begin::Cardaaa-->
<div class="card card-custom gutter-b">


    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="userDatatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Action</th>
                    <th>Chef Name</th>
                    <th>Video Title</th>
                    <th>Video</th>
                    <th>Cuisine Name</th>
                    <th>Language</th>
                </tr>
            </thead>
            <tbody>


            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->


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
        "sAjaxSource": "../serverresponse/chefvideo.php"
    });


    function remove(id) {
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

                    type: "POST",
                    url: "../ajax/deleteoffer.php",
                    data: "id=" + id,
                    success: function(data) {
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