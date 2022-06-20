<?php
$categary = "Master";
$pagename = isset($_GET['id']) ? "Edit Chef Tag" : "Add Chef Tag";
include '../include/header.php';
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : "";

if(isset($_GET["id"]))
{
    $getFaq = mysqli_fetch_array(mysqli_query($connection,"SELECT * FROM `cheftag` WHERE `cheftagId`='".$id."'"));
    $chefTagName = $getFaq['chefTagName'];
    // echo $chefTagName;
    // exit;
   
}  

if (isset($_REQUEST['save'])) {
    $chefTagName = $_REQUEST['chefTagName'];
   
    $flag=1;

    if($chefTagName==""){
        $chefTagNameError="<div class='error'>Tag Name Required</div>";
        $flag=0;
    }


    if($flag == 1)
	{
        if(isset($_GET['id']))
        {
            $addFaq = mysqli_query($connection, "UPDATE `cheftag` SET `chefTagName`='" . $chefTagName . "',`adminId`='" . $_SESSION['admin'] . "' WHERE `cheftagId`='".$id."'");
            if($addFaq){
                header("location:../cheftag");
            }
            // header("location:../cheftag");
        }
        else
        {
            $addFaq = mysqli_query($connection, "INSERT INTO `cheftag` SET `chefTagName`='" . $chefTagName . "',`adminId`='" . $_SESSION['admin'] . "'");
            header("location:../cheftag");
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
            <form class="form" method="post" id="myForm" enctype="multipart/form-data">
                <div class="card-body">

                    
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Tag Name</strong> </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?php if (isset($chefTagName)) { echo $chefTagName; } ?>" name="chefTagName" placeholder="Enter Tag" />
                            <?php if (isset($chefTagNameError)) { echo $chefTagNameError; } ?>
                        </div>
                    </div>
                   


                </div>

                <div class="card-footer">

                    <div class="row">
                        <div class="col-lg-12" style="text-align: center;">
                            <button type="submit" name="save" class="btn btn-primary cebutton mr-2"><?php echo $pagename; ?></button>
                            <button onClick="window.location.href='../viewfaq/';" type="button" class="btn btn-secondary">Cancel</button>
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