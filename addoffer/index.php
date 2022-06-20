<?php
$categary = "Setting";
$pagename = isset($_GET['id']) ? "Edit Offer" : "Add Offer";
$save = isset($_GET['id']) ? "Save Changes" : "Save";
include '../include/header.php';
$couponId = isset($_GET['id']) ? base64_decode($_GET['id']) : "";
if (isset($_GET['id'])) {
    $offerData = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `offercoupon` WHERE `couponId`='" . $couponId . "'"));
    $offercode = $offerData['couponCode'];
    $discount = $offerData['discount'];
    $startdate = $offerData['startDate'];
    $enddate = $offerData['endDate'];
    $description = $offerData['description'];
    $tac = $offerData['tac'];
    $minimumAmount = $offerData['minimumAmount'];
    $maximumAmount = $offerData['maximumAmount'];
    $discountType = $offerData['discountType'];

}



if (isset($_POST['save'])) {
    $offercode = $_POST['offercode'];
    $discount = $_POST['discount'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $description = $_POST['description'];
    $tac = $_POST['tac'];
    $minimumAmount = $_POST['minimumAmount'];
    $maximumAmount = $_POST['maximumAmount'];
    $discountType = $_POST['discountType'];

    $check = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `offercoupon` WHERE `couponCode`='" . $offercode . "' AND `delete`='0' "));

    if (isset($_GET['id'])) {
        $checkEdit = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `offercoupon` WHERE `couponCode`='" . $offercode . "' AND `couponId`!='" . $couponId . "' AND `delete`='0' "));
        if ($checkEdit > 0) {
            $existError = "<div style='color:red;'>PromoCode Aleray Exists";
        } else {
            $insert = mysqli_query($connection, "UPDATE `offercoupon` SET 
            `couponCode`='" . $offercode . "',
            `description`='" . $description . "',
            `startDate`='" . $startdate . "',
            `endDate`='" . $enddate . "',
            `discount`='" . $discount . "',
            `tac`='" . $tac . "',
            `minimumAmount`='" . $minimumAmount . "',
            `discountType`='".$discountType."',
            `maximumAmount`='" . $maximumAmount . "' 
            WHERE `couponId`='" . $couponId . "'");
            header("location:../walletoffers/");
        }
    } else {
        if ($check > 0) {
            $existError = "<div style='color:red;'>PromoCode Aleray Exists</div>";
        } else {
            $insert = mysqli_query($connection, "INSERT INTO `offercoupon` SET 
            `couponCode`='" . $offercode . "',
            `description`='" . $description . "',
            `startDate`='" . $startdate . "',
            `endDate`='" . $enddate . "',
            `discount`='" . $discount . "',
            `discountType`='".$discountType."',
            `tac`='" . $tac . "',
            `minimumAmount`='" . $minimumAmount . "',
            `maximumAmount`='" . $maximumAmount . "'");
            header("location:../walletoffers/");
        }
    }
}
?>
<style>
    .error {
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
            <form class="form" method="POST" id="myForm" enctype="multipart/form-data">
                <div class="card-body">

                    
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Offer Code</strong> </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?php if (isset($offercode)) {echo $offercode;} ?>" name="offercode" placeholder="Enter Offer Code" />
                            <?php if (isset($offercodeError)) {echo $offercodeError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Offer Discount</strong> </label>
                        <div class="col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php if (isset($discount)) {echo $discount;} ?>" name="discount" placeholder="Enter Offer Discount" />
                            <!-- <div class="input-group-append"><span class="input-group-text ">%</span></div> -->
                        </div>
                            <?php if (isset($discountError)) { echo $discountError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Discount Type</strong> </label>
                        <div class="col-lg-4">
                            <!-- <input type="date" class="form-control" value="<?php if (isset($startdate)) {echo $startdate; } ?>" name="startdate" /> -->

                            <select class="form-control" name="discountType">
                                <option value="percentage"  <?php if (isset($enddate)) { if($discountType=="percentage"){echo "selected";}}?>>Percentage</option>
                                <option value="flat" <?php if (isset($enddate)) { if($discountType=="flat"){echo "selected";}}?>>Flat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Start Date</strong> </label>
                        <div class="col-lg-4">
                            <input type="date" class="form-control" value="<?php if (isset($startdate)) {echo $startdate; } ?>" name="startdate" />

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>End Date</strong> </label>
                        <div class="col-lg-4">
                            <input type="date" class="form-control" value="<?php if (isset($enddate)) {echo $enddate; } ?>" name="enddate" />

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Description</strong> </label>
                        <div class="col-lg-4">
                            <textarea type="text" class="form-control" name="description" placeholder="Enter Description"><?php if (isset($description)) {echo $description;} ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Terms & Conditions</strong> </label>
                        <div class="col-lg-4">
                            <textarea type="text" class="form-control" name="tac" placeholder="Enter Terms & Conditionss"><?php if (isset($tac)) {echo $tac;} ?></textarea>
                            <?php if (isset($tncError)) {echo $tncError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Minimum Amount</strong> </label>
                        <div class="col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php if (isset($minimumAmount)) {echo $minimumAmount;} ?>" name="minimumAmount" placeholder="Enter Minimum Amount" />
                            <div class="input-group-append"><span class="input-group-text ">Rs</span></div>
                        </div>
                            <?php if (isset($minimumAmountError)) {echo $minimumAmountError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Maximum Amount</strong> </label>
                        <div class="col-lg-4">
                        <div class="input-group">
                            <input type="text" class="form-control" value="<?php if (isset($maximumAmount)) {echo $maximumAmount;} ?>" name="maximumAmount" placeholder="Enter Maximum Amount" />
                            <div class="input-group-append"><span class="input-group-text ">Rs</span></div>
                        </div>
                            <?php if (isset($maximumAmountError)) { echo $maximumAmountError; } ?>
                        </div>
                    </div>
                    

                </div>

                <div class="card-footer">

                    <div class="row">
                        <div class="col-lg-12" style="text-align: center;">
                            
                            <button onClick="window.location.href='../diet/';" type="button" class="btn btn-secondary">Cancel</button>
                            <button type="submit" name="save" class="btn btn-primary cebutton mr-2"><?php echo $save; ?></button>
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
include '../include/footer.php';
?>