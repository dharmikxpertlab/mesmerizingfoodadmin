<?php
$categary = "Master";
$pagename = isset($_GET['id']) ? "Edit FAQ" : "Add FAQ";
include '../include/header.php';
$faqId = isset($_GET['id']) ? base64_decode($_GET['id']) : "";
if(isset($_GET["id"]))
{
    $getFaq = mysqli_fetch_array(mysqli_query($connection,"SELECT * FROM `faq` WHERE `faqId`='".$faqId."'"));
    $question = $getFaq['question'];
    $answer = $getFaq['answer'];
}  
if (isset($_REQUEST['save'])) {
    $question = $_REQUEST['question'];
    $answer = $_REQUEST['answer'];

    $flag=1;

    if($question==""){
        $questionError="<div class='error'>Question Required</div>";
        $flag=0;
    }
    if($answer==" "){
        $answerError="<div class='error'>Answer Required</div>";
        $flag=0;
    }

    if($flag == 1)
	{
        if(isset($_GET['id']))
        {
            $addFaq = mysqli_query($connection, "UPDATE `faq` SET `question`='" . $question . "',`answer`='" . $answer . "',`adminId`='" . $_SESSION['admin'] . "' WHERE `faqId`='".$faqId."'");
            header("location:../viewfaq");
        }
        else
        {
            $addFaq = mysqli_query($connection, "INSERT INTO `faq` SET `question`='" . $question . "',`answer`='" . $answer . "',`adminId`='" . $_SESSION['admin'] . "'");
            header("location:../viewfaq");
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

                    <?php if (isset($existError)) {
                        echo $existError;
                    } ?>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Question</strong> </label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" value="<?php if (isset($question)) { echo $question; } ?>" name="question" placeholder="Enter Question" />
                            <?php if (isset($questionError)) { echo $questionError; } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-2"></div>
                        <label class="col-lg-2" style="margin-top: 10px;"><span style="color:red;font-size:15px;">*</span><strong>Answer</strong> </label>
                        <div class="col-lg-4">
                            <textarea type="text" class="form-control" name="answer" placeholder="Enter Answer">
                                <?php if (isset($answer)) {
                                    echo $answer;
                                }
                                ?>
                            </textarea>
                            <?php if(isset($answerError)) { echo $answerError; } ?>
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