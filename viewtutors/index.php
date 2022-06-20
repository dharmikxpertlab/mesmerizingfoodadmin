<?php
$categary = "Tutor App";
$pagename = "Tutors";
include "../include/header.php";
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : "";

if (isset($_GET['id'])) {
    $viewtutor = mysqli_fetch_array(mysqli_query($connection, "select * from `chef` where `chefId` = '$id'"));
    $totalcoin = mysqli_fetch_array(mysqli_query($connection, "select SUM(coin) as coin from `wallethistory` where `id` = '$id' and `type`='tutor' and `operation`= 'credit'"));
    $Withdrawcoin = mysqli_fetch_array(mysqli_query($connection, "select SUM(coin) as coin from `wallethistory` where `id` = '$id' and `type`='tutor' and `operation`= 'debit'"));
    $countpost = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) as post FROM `chefpost` WHERE `chefId` = '$id'"));
    $retingCount = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(*) as reting FROM `rating` WHERE `chefId` = '$id'"));

    $userreting = mysqli_query($connection, "SELECT userId FROM `rating` WHERE `chefId` = '$id'");

    if ($Withdrawcoin['coin'] == null) {
        $Withdrawcoin['coin'] = 0;
    }
    // print_r($userreting);
    // echo $retingCount['post'];
    // exit;



}



?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!-- begin::Subheader -->
    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Details-->
            <div class="d-flex align-items-center flex-wrap mr-2">
                <!--begin::Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?php echo $categary; ?></h5>
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


    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <!--begin::Top-->
            <div class="d-flex">
                <!--begin::Pic-->
                <div class="flex-shrink-0 mr-7">
                    <div class="symbol symbol-50 symbol-lg-120">
                        <img alt="Pic" src="https://gogagner.com/api/src/TutorImages/<?php echo $viewtutor['profilePic'] ?>" />
                    </div>
                </div>
                <!--end::Pic-->

                <!--begin: Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex align-items-center justify-content-between flex-wrap mt-2">
                        <!--begin::User-->
                        <div class="mr-3">
                            <!--begin::Name-->
                            <a class="d-flex align-items-center text-dark  font-size-h5 font-weight-bold mr-3">
                                <?php echo $viewtutor['fullName']; ?> <?php if ($viewtutor['approve'] == 1) {
                                                                            echo '<i class="flaticon2-correct text-success icon-md ml-2"></i>';
                                                                        } ?>
                            </a>
                            <!--end::Name-->

                            <!--begin::Contacts-->
                            <div class="d-flex flex-wrap my-2">
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span> <?php echo $viewtutor['email']; ?>
                                </a>
                                <a href="#" class="text-muted text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <mask fill="white">
                                                    <use xlink:href="#path-1" />
                                                </mask>
                                                <g />
                                                <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span> <?php $cheftagId = $viewtutor['experienceType'];
                                            // $result = mysqli_fetch_assoc(mysqli_query($connection,"select * from `cheftag` where `delete` = 0 and `cheftagId`= $cheftagId"));
                                            echo $cheftagId ?>
                                </a>
                                <a href="#" class="text-muted text-hover-primary font-weight-bold">
                                    <span class="svg-icon svg-icon-md svg-icon-gray-500 mr-1">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Map/Marker2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M9.82829464,16.6565893 C7.02541569,15.7427556 5,13.1079084 5,10 C5,6.13400675 8.13400675,3 12,3 C15.8659932,3 19,6.13400675 19,10 C19,13.1079084 16.9745843,15.7427556 14.1717054,16.6565893 L12,21 L9.82829464,16.6565893 Z M12,12 C13.1045695,12 14,11.1045695 14,10 C14,8.8954305 13.1045695,8 12,8 C10.8954305,8 10,8.8954305 10,10 C10,11.1045695 10.8954305,12 12,12 Z" fill="#000000" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span> <?php echo $viewtutor['state']; ?>
                                </a>
                            </div>
                            <!--end::Contacts-->
                        </div>
                        <!--begin::User-->

                        <!--begin::Actions-->
                        <div class="my-lg-0 my-1">
                            <a href="#" onclick="block(<?php echo $id; ?>)" class="btn btn-sm btn-light-danger font-weight-bolder text-uppercase mr-2">block</a>
                            <!-- <a href="#" class="btn btn-sm btn-danger font-weight-bolder text-uppercase">block</a> -->
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <div class="d-flex align-items-center flex-wrap justify-content-between">
                        <!--begin::Description-->
                        <div class="flex-grow-1 font-weight-bold text-dark-50 py-2 py-lg-2 mr-5">
                            <?php echo $viewtutor['info']; ?>
                        </div>
                        <!--end::Description-->

                        <!--begin::Progress-->
                        <!-- <div class="d-flex mt-4 mt-sm-0">
                        <span class="font-weight-bold mr-4">Progress</span>
                        <div class="progress progress-xs mt-2 mb-2 flex-shrink-0 w-150px w-xl-250px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 63%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <span class="font-weight-bolder text-dark ml-4">78%</span>
                    </div> -->
                        <!--end::Progress-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Top-->

            <!--begin::Separator-->
            <div class="separator separator-solid my-7"></div>
            <!--end::Separator-->

            <!--begin::Bottom-->
            <div class="d-flex align-items-center flex-wrap">
                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-piggy-bank icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Wallet</span>
                        <span class="font-weight-bolder font-size-h5"> <?php echo $viewtutor['walletAmount']; ?> <span class="text-dark-50 font-weight-bold">Coins</span></span>
                    </div>
                </div>
                <!--end: Item-->

                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-coins icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Total Coins</span>
                        <span class="font-weight-bolder font-size-h5"> <?php echo $totalcoin['coin']; ?> <span class="text-dark-50 font-weight-bold"> Coins</span></span>
                    </div>
                </div>
                <!--end: Item-->

                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-share icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column text-dark-75">
                        <span class="font-weight-bolder font-size-sm">Total Withdraw</span>
                        <span class="font-weight-bolder font-size-h5"><?php echo $Withdrawcoin['coin']; ?> <span class="text-dark-50 font-weight-bold">Coins</span></span>
                    </div>
                </div>
                <!--end: Item-->

                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                    <span class="mr-4">
                        <i class="flaticon-file-2 icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="d-flex flex-column flex-lg-fill">
                        <span class="text-dark-75 font-weight-bolder font-size-sm"><?php echo $countpost['post']; ?> Post</span>
                        <a href="#" class="text-primary font-weight-bolder">View</a>
                    </div>
                </div>
                <!--end: Item-->

                <!--begin: Item-->
                <!-- <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
                <span class="mr-4">
                    <i class="flaticon-chat-1 icon-2x text-muted font-weight-bold"></i>
                </span>
                <div class="d-flex flex-column">
                    <span class="text-dark-75 font-weight-bolder font-size-sm">648 Comments</span>
                    <a href="#" class="text-primary font-weight-bolder">View</a>
                </div>
            </div> -->
                <!--end: Item-->

                <!--begin: Item-->
                <div class="d-flex align-items-center flex-lg-fill my-1">
                    <span class="mr-4">
                        <i class="flaticon-star icon-2x text-muted font-weight-bold"></i>
                    </span>
                    <div class="symbol-group symbol-hover">
                        <div class=" " style="margin-right: 15px;" data-toggle="tooltip">
                            <span class="font-weight-bolder font-size-h5"><?php echo $viewtutor['rating']; ?></span>
                        </div>

                        <?php $rowcount = mysqli_num_rows($userreting);
                        for ($i = 0; $i < 2; $i++) {
                            $id = mysqli_fetch_array($userreting);
                            // echo "SELECT fullName,profilePic FROM `user` WHERE `userId` = '$id[userId]'";
                            $user = mysqli_fetch_array(mysqli_query($connection, "SELECT fullName,profilePic FROM `user` WHERE `userId` = '$id[userId]'"));
                            //  print_r($user);
                        ?>
                            <div class="symbol symbol-30 symbol-circle" data-toggle="tooltip" title="<?php echo $user['fullName']; ?>">
                                <img alt="Pic" src="https://gogagner.com/api/src/UserImages/<?php echo $user['profilePic']; ?>" />
                            </div>

                        <?php } ?>
                        <?php if ($rowcount > 2) {
                        ?>
                            <div class="symbol symbol-30  symbol-circle symbol-light" data-toggle="tooltip" title="More users">
                                <span class="symbol-label font-weight-bold"><?php echo $rowcount - 2 ?>+</span>
                            </div>

                        <?php } ?>


                    </div>
                </div>
                <!--end: Item-->
            </div>
            <!--end::Bottom-->
        </div>
    </div>
    <!--end::Card-->



    <!--begin::Card-->
    <div class="card card-custom gutter-b">
        <?php


        // $charlist="[ ]";
        //       $val=explode(",",trim($viewtutor["specialityDish"],$charlist));

        // print_r(implode(',',$val));


        //   trim($string, $charlist)
        ?>
        <div class="card-body">

            <table class="table table-separate table-head-custom table-checkable" id="userDatatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Actions</th>

                        <th>Dish Name</th>




                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>


        </div>
    </div>
</div>

<?php
include "../include/footer.php";
?>
<script>
    //TABLE
    var table =   $('#userDatatable').DataTable({
        scrollY: '50vh',
        scrollX: true,
        scrollCollapse: true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "../serverresponse/dishesoftutor.php?id=<?php echo $viewtutor["chefId"]  ?>"
    });



    function editDish(id,name) {



         Swal.fire({
            title: 'Enter your IP address',
            input: 'text',
            inputLabel: 'Your IP address',
            inputValue: name,
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!'
                }else{
            $.ajax({

                    type: "POST",
                    url: "../ajax/updatedishname.php",
                    data: {
                        id:id,
                        name:value
                    },
                    success: function(data) {
                        if (data == 'Success') {
                            Swal.fire(
                                
                                "Dish Name Changed!",
                                "success",

                            )
                            setTimeout(table.ajax.reload(), 600);
                        }

                    }

                });

                }
            }
        })
        // Swal.fire({
        //     title: "Are you sure?",
        //     text: "You won't block this!",
        //     icon: "warning",
        //     showCancelButton: true,
        //     confirmButtonText: "Yes, block it!",
        //     cancelButtonText: 'No, Cancel!',
        //     reverseButtons: true
        // }).then(function(result) {
        //     if (result.value) {
        //         $.ajax({

        //             type: "POST",
        //             url: "../ajax/tutorsblock.php",
        //             data: "id=" + id,
        //             success: function(data) {
        //                 if (data == 'block') {
        //                     Swal.fire(
        //                         "blocked!",
        //                         "Your tutor has been block.",
        //                         "success",

        //                     )
        //                     setTimeout("location.reload(true);", 600);
        //                 }

        //             }

        //         });
        //     }

        // });


    }
</script>