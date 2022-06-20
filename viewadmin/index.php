<?php
$categary = "Master";
$pagename = "Admin";
include  '../include/header.php'; ?>

<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                Admin

            </h3>
        </div>
        <div class="card-toolbar">

            <!--begin::Button-->
            <a href="../addadmin/" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span> Add Admin
            </a>
            <!--end::Button-->
        </div>
    </div>

    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="admin">
            <thead>
                <tr>
                    <th>SR NO</th>
                    <th>Action</th>
                    <th>Admin Name</th>
                    <th>Mobile Number</th>
                    <th>Email</th>

                </tr>
            </thead>

            <tbody>

            </tbody>

        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
<?php include '../include/footer.php'; ?>
<?php if (isset($_SESSION['adminpassword'])) {
    echo "<script>toastr.success('Updated Successfully.')</script>";
    unset($_SESSION['adminpassword']);
} ?>
<script>
    $(document).ready(function() {

        var table = $('#admin');
        table.DataTable({
            "scrollX": true,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "../serverresponse/admin.php"
        });


    });
</script>

<script>
    function block(adminId) {

        Swal.fire({
            text: "Are you sure to Block this Admin?",
            icon: "question",
            showCancelButton: true,
            cancelButtonText: 'No',
            buttonsStyling: false,
            confirmButtonText: "Yes",
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }
        }).then(function(result) {

            if (result.isConfirmed) {
                //var reason = result.value;
                $.ajax({
                    url: "../ajax/blockadmin.php",
                    method: "post",
                    data: {
                        adminId: adminId
                    },
                    success: function(response) {
                        $('#admin').DataTable().ajax.reload();
                        if (response == "Success") {
                            toastr.error("Blocked Successfully");

                        }
                    }
                });


            }

        });

    }

    function unblock(adminId) {

        Swal.fire({
            text: "Are you sure to unblock this Admin?",
            icon: "question",
            showCancelButton: true,
            cancelButtonText: 'No',
            buttonsStyling: false,
            confirmButtonText: "Yes",
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }
        }).then(function(result) {

            if (result.isConfirmed) {
                //var reason = result.value;
                $.ajax({
                    url: "../ajax/unblockadmin.php",
                    method: "post",
                    data: {
                        adminId: adminId
                    },
                    success: function(response) {
                        $('#admin').DataTable().ajax.reload();
                        if (response == "Success") {
                            toastr.success("Unblocked Successfully");

                        }
                    }
                });


            }

        });

    }

    function delet(adminId) {

        Swal.fire({
            text: "Are you sure to Delete This Admin?",
            icon: "question",
            showCancelButton: true,
            cancelButtonText: 'No',
            buttonsStyling: false,
            confirmButtonText: "Yes",
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            }
        }).then(function(result) {

            if (result.isConfirmed) {
                //var reason = result.value;
                $.ajax({
                    url: "../ajax/deleteadmin.php",
                    method: "post",
                    data: {
                        adminId: adminId
                    },
                    success: function(response) {
                        $('#admin').DataTable().ajax.reload();
                        if (response == "Success") {
                            toastr.error("Deleted Successfully");

                        }
                    }
                });


            }

        });

    }
</script>