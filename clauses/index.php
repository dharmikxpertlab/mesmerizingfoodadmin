<?php
$categary = "InformativeScreens";
$pagename = "Clauses";
include '../include/header.php'; ?>
<?php
$getQuery = mysqli_query($connection, "SELECT * FROM `content` WHERE `contentId`='3'");
$tncArray = mysqli_fetch_array($getQuery);
$tnc = $tncArray['contentData'];
if (isset($_POST['tnc'])) {
    $termsAndConditions = $_POST['terms'];
    if ($termsAndConditions == "") {
        $termsAndConditions = $tnc;
    }
    $insertQuery = mysqli_query($connection, "UPDATE `content` SET `contentData`='" . $termsAndConditions . "' WHERE `contentId`=3");

    header("location:../clauses/");
}
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
<!--begin::Card-->
<div class="card card-custom gutter-b example example-compact">
    <div class="card-header">
        <h3 class="card-title">
            Clauses
        </h3>
        <div class="card-toolbar">

            <!--begin::Button-->
            <button class="btn btn-primary font-weight-bolder" id="edittnc" name="edit">
                Edit
            </button>

            <!--end::Button-->
        </div>
    </div>
    <!--begin::Form-->
    <form class="form" id="tnc" method="POST">
        <div class="card-body">
            <div class="form-group">

                <textarea class="form-control form-control-solid" name="terms" rows="25"> <?php if (isset($tnc)) {
                                                                                                echo $tnc;
                                                                                            } ?> </textarea>
            </div>


        </div>
        <div class="card-footer">
            
            <a href="../dashboard/" class="btn btn-secondary">Cancel</a>
            <button type="submit" id="tnc" name="tnc" class="btn btn-primary mr-2">Save</button>
        </div>
    </form>
    <!--end::Form-->
</div>
<!--end::Card-->
</div>
<?php include '../include/footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script>
    $("#edittnc").on("click", function() {
        $("#edittoview").text("Edit")
    })

    $("#tnc").validate({
        rules: {
            terms: {
                required: true,
            }
        },
        messages: {
            terms: {
                required: "Please Enter Terms And Conditions.",
            }
        }
    })
    $(document).ready(function() {

        $("form textarea[name=terms]").prop("disabled", true);

        $("button[name=edit]").on("click", function() {

            $("textarea[name=terms]").removeAttr("disabled");
        })

    })
</script>