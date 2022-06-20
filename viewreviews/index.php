<?php
$categary = "Master";
$pagename = "Chef Reviews";
include '../include/header.php';
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : '';
$tutorReview = mysqli_query($connection, "SELECT `rating`.*,`chef`.`fullName` as `chefName`,`user`.`fullName` as `userName`,`user`.`userId` FROM `rating` LEFT JOIN `chef` ON `rating`.`chefId`=`chef`.`chefId` LEFT JOIN `user` ON `rating`.`userId`=`user`.`userId`
WHERE `rating`.`chefId`='" . $id . "' AND `rating`.`delete`=0");
?>
<!--begin::Cardaaa-->
<div class="card card-custom gutter-b">


    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="userDatatable">
            <thead>
                <tr>
                    <th>SR NO.</th>
                    <th>Action</th>
                    <th>Chef Name</th>
                    <th>User Name</th>
                    <th>Rating</th>
                    <th>Feedback</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($row = mysqli_fetch_array($tutorReview)) { ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><button onclick="remove(<?php echo $row['ratingId']; ?>,<?php echo $row['userId']; ?>)" style="width: 30px;height: 30px;" title="Delete" data-toggle="tooltip" data-theme="dark" data-placement="right\" class="btn btn-icon btn-danger\"><i class="fas fa-trash"></i></button><button onclick="change(<?php echo $row['ratingId'];; ?>,<?php echo $row['userId']; ?>)" style="width: 30px;height: 30px;" title="Delete" data-toggle="tooltip" data-theme="dark" data-placement="right\" class="btn btn-icon btn-danger\"><i class="fas fa-edit"></i></button></td>
                        <td><?php echo $row['chefName'] ?></td>
                        <td><?php echo $row['userName'] ?></td>

                        <td> <input type="text" name="" id="<?php echo $row['userId']; ?>rating" value="<?php echo $row['rating'] ?>" style="border:none"> </td>
                        <td><input type="text" name="" id="<?php echo $row['userId']; ?>review" value="<?php echo $row['review'] ?>" style="border:none"></td>

                        <td><?php echo $row['created'] ?></td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
<?php
include '../include/footer.php';
?>
<script>
    var rating = "";
    var review = '';

    function change(id, number) {

        Swal.fire({
            title: "Are you sure?",
            text: "You want to update!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: 'No, Cancel!',
            reverseButtons: true
        }).then(function(result) {

            if (result.value) {
                id = id;
                number = number;
                rating = "#" + number + 'rating';
                review = "#" + number + 'review';
                rating = $(rating).val();
                review = $(review).val();

                $.ajax({

                    type: "POST",
                    url: "../ajax/updatereview.php",
                    data: {
                        id: id,
                        rating: rating,
                        review: review,
                    },
                    success: function(data) {
                        if (data == 'Success') {
                            Swal.fire(
                                "Updated!",
                                "Your Review has been updated.",
                                "success",

                            )
                            setTimeout("location.reload(true);", 600);
                        }

                    }

                });
            }

        });
    }

    function remove(id, number) {

        Swal.fire({
            title: "Are you sure?",
            text: "You want to Delete!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: 'No, Cancel!',
            reverseButtons: true
        }).then(function(result) {

            if (result.value) {
                id = id;


                $.ajax({

                    type: "POST",
                    url: "../ajax/deletereview.php",
                    data: {
                        id: id,

                    },
                    success: function(data) {
                        if (data == 'Success') {
                            Swal.fire(
                                "Deleted!",
                                "Your Review has been Deleted.",
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