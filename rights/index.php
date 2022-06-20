<?php
    $categary = "Master";
    $pagename = "Rights";
//$pageMenuId =
include("../include/header.php");

$_GET['roleId'] = base64_decode($_GET['roleId']);
$roleId =  $_GET['roleId'];

if (isset($_POST['roleId'])) {
    if ($_POST['roleId'] > 0) {
        header('location:../viewrights-' . base64_encode($_POST['roleId']) . '/');
    } else {
        header('location:../viewrights/');
    }
}

if (isset($_POST['saverights'])) {

    $menuadd = array();
    $menuedit = array();
    $menuview = array();
    $menudelete = array();
    $submenuadd = array();
    $submenuedit = array();
    $submenuview = array();
    $submenudelete = array();

    if (isset($_POST['menuadd'])) {
        foreach ($_POST['menuadd'] as $value) {
            $menuadd[] = $value;
        }
    }
    if (isset($_POST['menuedit'])) {
        foreach ($_POST['menuedit'] as $value) {
            $menuedit[] = $value;
        }
    }
    if (isset($_POST['menudelete'])) {
        foreach ($_POST['menudelete'] as $value) {
            $menudelete[] = $value;
        }
    }
    if (isset($_POST['menuview'])) {
        foreach ($_POST['menuview'] as $value) {
            $menuview[] = $value;
        }
    }
    if (isset($_POST['submenuadd'])) {
        foreach ($_POST['submenuadd'] as $value) {
            $menuRow = mysqli_fetch_array(mysqli_query($connection, "SELECT `mainMenuId` FROM `menu` WHERE `menuId` = '" . $value . "'"));
            if (!in_array($menuRow['mainMenuId'], $menuview)) {
                $menuview[] = $menuRow['mainMenuId'];
            }
            $submenuadd[] = $value;
        }
        $menuadd = array_merge($menuadd, $submenuadd);
    }
    if (isset($_POST['submenuedit'])) {
        foreach ($_POST['submenuedit'] as $value) {
            $menuRow = mysqli_fetch_array(mysqli_query($connection, "SELECT `mainMenuId` FROM `menu` WHERE `menuId` = '" . $value . "'"));
            if (!in_array($menuRow['mainMenuId'], $menuview)) {
                $menuview[] = $menuRow['mainMenuId'];
            }
            $submenuedit[] = $value;
        }
        $menuedit = array_merge($menuedit, $submenuedit);
    }
    if (isset($_POST['submenudelete'])) {
        foreach ($_POST['submenudelete'] as $value) {
            $menuRow = mysqli_fetch_array(mysqli_query($connection, "SELECT `mainMenuId` FROM `menu` WHERE `menuId` = '" . $value . "'"));
            if (!in_array($menuRow['mainMenuId'], $menuview)) {
                $menuview[] = $menuRow['mainMenuId'];
            }
            $submenudelete[] = $value;
        }
        $menudelete = array_merge($menudelete, $submenudelete);
    }
    if (isset($_POST['submenuview'])) {
        foreach ($_POST['submenuview'] as $value) {
            $menuRow = mysqli_fetch_array(mysqli_query($connection, "SELECT `mainMenuId` FROM `menu` WHERE `menuId` = '" . $value . "'"));
            if (!in_array($menuRow['mainMenuId'], $menuview)) {
                $menuview[] = $menuRow['mainMenuId'];
            }
            $submenuview[] = $value;
        }
        $menuview = array_merge($menuview, $submenuview);
    }
    $menuaddString = implode(",", $menuadd);
    $menueditString = implode(",", $menuedit);
    $menudeleteString = implode(",", $menudelete);
    $menuviewString = implode(",", $menuview);

    $updateQuery = "UPDATE `role` SET `menuIdAdd` = '$menuaddString',`menuIdEdit` = '$menueditString',`menuIdView` = '$menuviewString',`menuIdDelete` = '$menudeleteString' WHERE `roleId` = '" . $_GET['roleId'] . "'";
    if ($updateResult = mysqli_query($connection, $updateQuery)) {
        $success = 1;
    }
}
$assignedmenuadd = array();
$assignedmenuview = array();
$assignedmenuedit = array();
$assignedmenudelete = array();
$row = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `role` WHERE `roleId` = '$roleId'"));
$assignedmenuadd = explode(",", $row['menuIdAdd']);
$assignedmenuview = explode(",", $row['menuIdView']);
$assignedmenuedit = explode(",", $row['menuIdEdit']);
$assignedmenudelete = explode(",", $row['menuIdDelete']);
?>

<style>
    .m-checkbox {
        padding-bottom: 15px;
    }
</style>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">

    <!--begin::Entry-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                    <!--begin::Title-->
                                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Rights</h1>
                                    <!--end::Title-->
                                    <!--begin::Separator-->
                                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                                    <!--end::Separator-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a class="text-muted text-hover-primary"><?php
                                                                                        $roleDataQuery = mysqli_query($connection, "SELECT * FROM `role` WHERE `roleId`=" . $roleId);
                                                                                        $roleData = mysqli_fetch_array($roleDataQuery);
                                                                                        echo $roleData['roleName'];
                                                                                        ?></a>
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                            </div>
                            <!--end::Card title-->
                            <div class="card-toolbar">
                                <div class="example-tools justify-content-center">
                                    <span class="example-toggle" data-toggle="tooltip" title="View code" style="display: none"></span>
                                    <span class="example-copy" data-toggle="tooltip" title="Copy code" style="display: none"></span>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <div class="card-body">
                            <div class="row" style="<?php if (!isset($_GET['roleId'])) {
                                                        echo "display:none;";
                                                    } ?>">
                                <div class="col-md-12 ">

                                    <form method="post" class="portlet box blue-hoki">

                                        <div class="portlet-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-header-fixed nowrap" role="grid" width="100%" cellspacing="0" style="color:#FFF;">
                                                    <thead>
                                                        <tr style="background-image: linear-gradient(#023047, #1f8abf);color: white;">
                                                            <th class="all" style="border:none;border-right:1px solid white;border-bottom:2px solid white;"></th>
                                                            <th class="all" style="text-align:center">
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-5" style="font-weight:bold;font-size:15px;color: white">ADD</div>
                                                                    <div class="col-md-3" style="text-align: left;">
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck" name="menuAddAll" onChange="checkMenu(this,'menuAdd');" data-checkbox="icheckbox_square-green" value="">
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th class="all" style="text-align:center">
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-5" style="font-weight:bold;font-size:15px;color: white">EDIT</div>
                                                                    <div class="col-md-3" style="text-align: left;">
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck" name="menuEditAll" onChange="checkMenu(this,'menuEdit');" data-checkbox="icheckbox_square-green" value="" /><span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th class="all" style="text-align:center">
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-5" style="font-weight:bold;font-size:15px;color: white">VIEW</div>
                                                                    <div class="col-md-3" style="text-align: left;">
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck" name="menuViewAll" onChange="checkMenu(this,'menuView');" data-checkbox="icheckbox_square-green" value="" />
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                            <th class="all" style="text-align:center">
                                                                <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-5" style="font-weight:bold;font-size:15px;color: white">DELETE</div>
                                                                    <div class="col-md-3" style="text-align: left;">
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck" name="menuDeleteAll" onChange="checkMenu(this,'menuDelete');" data-checkbox="icheckbox_square-green" value="" />
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $menuQuery = "SELECT * FROM `menu` WHERE `mainMenuId` = '0' and `deleteMenu` = '0' order by `order` asc";
                                                        $menuResult = mysqli_query($connection, $menuQuery);
                                                        while ($menuRow = mysqli_fetch_array($menuResult)) {


                                                            $submenucount = mysqli_num_rows(mysqli_query($connection, "SELECT * FROM `menu` WHERE `mainMenuId` = '{$menuRow['menuId']}' AND `deleteMenu` = '0'"));

                                                        ?>
                                                            <tr style="background-color:white; color:black;">
                                                                <td style="text-align:center;  font-weight:bold;">
                                                                    <div class="row">
                                                                        <label class="col-md-9" style=""><?php echo $menuRow['menuName']; ?></label>
                                                                        <?php if ($submenucount == 0) { ?>
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-default col-md-3">
                                                                                <input type="checkbox" class="icheck" onChange="checkRowMenu(this,'menu')" name="rowmenuall" data-checkbox="icheckbox_square-green" value="<?php echo $menuRow['menuId']; ?>" /><span></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </div>
                                                                </td>
                                                                <td style="text-align:center;"><?php if ($menuRow['add'] == 'YES' && $submenucount == 0) { ?>
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck rowmenu<?php echo $menuRow['menuId']; ?>" name="menuadd[]" data-checkbox="icheckbox_square-green" value="<?php echo $menuRow['menuId']; ?>" <?php
                                                                                                                                                                                                                                                                if (in_array($menuRow['menuId'], $assignedmenuadd)) {
                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                ?> /><span></span>
                                                                        </label>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="text-align:center;"><?php if ($menuRow['edit'] == 'YES' && $submenucount == 0) { ?>
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck rowmenu<?php echo $menuRow['menuId']; ?>" name="menuedit[]" data-checkbox="icheckbox_square-green" value="<?php echo $menuRow['menuId']; ?>" <?php
                                                                                                                                                                                                                                                                if (in_array($menuRow['menuId'], $assignedmenuedit)) {
                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                ?> /><span></span>
                                                                        </label>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="text-align:center;">
                                                                    <?php if ($menuRow['view'] == 'YES' && $submenucount == 0) { ?>
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck viewMenu rowmenu<?php echo $menuRow['menuId']; ?>" name="menuview[]" data-checkbox="icheckbox_square-green" value="<?php echo $menuRow['menuId']; ?>" <?php if ((in_array($menuRow['menuId'], $assignedmenuview))) {
                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                        } ?> /><span></span>
                                                                        </label>
                                                                    <?php } ?>
                                                                </td>
                                                                <td style="text-align:center;"><?php if ($menuRow['delete'] == 'YES' && $submenucount == 0) { ?>
                                                                        <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                            <input type="checkbox" class="icheck rowmenu<?php echo $menuRow['menuId']; ?>" name="menudelete[]" data-checkbox="icheckbox_square-green" value="<?php echo $menuRow['menuId']; ?>" <?php if (in_array($menuRow['menuId'], $assignedmenudelete)) {
                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                } ?> /><span></span>
                                                                        </label>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                            $submenuQuery = "SELECT * FROM `menu` WHERE `mainMenuId` = '{$menuRow['menuId']}' AND `delete` != '1' AND `deleteMenu` = '0' order by `order` asc";
                                                            $submenuResult = mysqli_query($connection, $submenuQuery);
                                                            while ($submenuRow = mysqli_fetch_array($submenuResult)) {

                                                            ?>
                                                                <tr style="background-color:#D6A93B;">
                                                                    <td style="text-align:center; font-weight:bold;border-top:none;border-bottom:none;">
                                                                        <div class="row">
                                                                            <label class="col-md-9" style="text-align:right;"><?php echo $submenuRow['menuName']; ?></label>
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-default col-md-3">
                                                                                <input type="checkbox" class="icheck" onChange="checkRowMenu(this,'submenu')" name="rowsubmenuall" data-checkbox="icheckbox_square-green" value="<?php echo $submenuRow['menuId']; ?>" /><span></span>
                                                                            </label>
                                                                        </div>

                                                                    </td>
                                                                    <td style="text-align:center;"><?php if ($submenuRow['add'] == 'YES') { ?>
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                                <input type="checkbox" class="icheck rowsubmenu<?php echo $submenuRow['menuId']; ?> rowmenu<?php echo $menuRow['menuId']; ?>" name="submenuadd[]" data-checkbox="icheckbox_square-green" value="<?php echo $submenuRow['menuId']; ?>" <?php
                                                                                                                                                                                                                                                                                                                        if (in_array($submenuRow['menuId'], $assignedmenuadd)) {
                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                        ?> /><span></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td style="text-align:center;"><?php if ($submenuRow['edit'] == 'YES') { ?>
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                                <input type="checkbox" class="icheck rowsubmenu<?php echo $submenuRow['menuId']; ?> rowmenu<?php echo $menuRow['menuId']; ?>" name="submenuedit[]" data-checkbox="icheckbox_square-green" value="<?php echo $submenuRow['menuId']; ?>" <?php
                                                                                                                                                                                                                                                                                                                        if (in_array($submenuRow['menuId'], $assignedmenuedit)) {
                                                                                                                                                                                                                                                                                                                            echo "checked";
                                                                                                                                                                                                                                                                                                                        }
                                                                                                                                                                                                                                                                                                                        ?> /><span></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td style="text-align:center;">
                                                                        <?php if ($submenuRow['view'] == 'YES') { ?>
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                                <input type="checkbox" class="icheck viewMenu rowsubmenu<?php echo $submenuRow['menuId']; ?> rowmenu<?php echo $menuRow['menuId']; ?>" name="submenuview[]" data-checkbox="icheckbox_square-green" value="<?php echo $submenuRow['menuId']; ?>" <?php
                                                                                                                                                                                                                                                                                                                                if (in_array($submenuRow['menuId'], $assignedmenuview)) {
                                                                                                                                                                                                                                                                                                                                    echo "checked";
                                                                                                                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                                                                                                                ?> /><span></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td style="text-align:center;"><?php if ($submenuRow['delete'] == 'YES') { ?>
                                                                            <label class="m-checkbox m-checkbox--solid m-checkbox--state-default">
                                                                                <input type="checkbox" class="icheck rowsubmenu<?php echo $submenuRow['menuId']; ?> rowmenu<?php echo $menuRow['menuId']; ?>" name="submenudelete[]" data-checkbox="icheckbox_square-green" value="<?php echo $submenuRow['menuId']; ?>" <?php
                                                                                                                                                                                                                                                                                                                            if (in_array($submenuRow['menuId'], $assignedmenudelete)) {
                                                                                                                                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                                                                                                                                            }
                                                                                                                                                                                                                                                                                                                            ?> /><span></span>
                                                                            </label>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php

                                                            }
                                                            ?>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12" style="text-align: center;">

                                                    <button class="btn apac-grad" type="submit" name="saverights"> Save Rights </button>

                                                    <input type="hidden" name="saverights">

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Subheader-->

<?php include("../include/footer.php"); ?>
<script type="text/javascript">
    $('.selectData').select2({
        placehodler: "Select Role"
    });
</script>
<script>
    function checkMenu(thiss, type) {
        if (type == 'menuAdd') {
            if ($(thiss).prop("checked") == true) {
                $("input[name=\"menuadd[]\"]").attr('checked', true);
                $("input[name=\"submenuadd[]\"]").attr('checked', true);
                $("input[name=\"menuadd[]\"]").closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);

                $("input[name=\"submenuadd[]\"]").closest("tr").find($("input[name=\"submenuview[]\"]")).attr('checked', true);
            } else {
                $("input[name=\"menuadd[]\"]").attr('checked', false);
                $("input[name=\"submenuadd[]\"]").attr('checked', false);
            }
        } else if (type == 'menuEdit') {
            if ($(thiss).prop("checked") == true) {
                $("input[name=\"menuedit[]\"]").attr('checked', true);
                $("input[name=\"submenuedit[]\"]").attr('checked', true);
            } else {
                $("input[name=\"menuedit[]\"]").attr('checked', false);
                $("input[name=\"submenuedit[]\"]").attr('checked', false);
            }
        } else if (type == 'menuDelete') {
            if ($(thiss).prop("checked") == true) {
                $("input[name=\"menudelete[]\"]").attr('checked', true);
                $("input[name=\"submenudelete[]\"]").attr('checked', true);
            } else {
                $("input[name=\"menudelete[]\"]").attr('checked', false);
                $("input[name=\"submenudelete[]\"]").attr('checked', false);
            }
        } else if (type == 'menuView') {
            if ($(thiss).prop("checked") == true) {
                $("input[name=\"menuview[]\"]").attr('checked', true);
                $("input[name=\"submenuview[]\"]").attr('checked', true);
            } else {
                $("input[name=\"menuview[]\"]").attr('checked', false);
                $("input[name=\"submenuview[]\"]").attr('checked', false);
                $(".rowmenu1").attr('checked', true);
                $(".rowmenu50").attr('checked', true);

                $("input[name=\"menuadd[]\"]").each(function(i, obj) {
                    if ($(this).prop("checked") == true) {
                        $(this).closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);
                    }
                });

                $("input[name=\"submenuadd[]\"]").each(function(i, obj) {
                    if ($(this).prop("checked") == true) {
                        $(this).closest("tr").find($("input[name=\"submenuview[]\"]")).attr('checked', true);
                    }
                });

                $("input[name=\"menuedit[]\"]").each(function(i, obj) {
                    if ($(this).prop("checked") == true) {
                        $(this).closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);
                    }
                });

                $("input[name=\"submenuedit[]\"]").each(function(i, obj) {
                    if ($(this).prop("checked") == true) {
                        $(this).closest("tr").find($("input[name=\"submenuview[]\"]")).attr('checked', true);
                    }
                });

                $("input[name=\"menudelete[]\"]").each(function(i, obj) {
                    if ($(this).prop("checked") == true) {
                        $(this).closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);
                    }
                });

                $("input[name=\"submenudelete[]\"]").each(function(i, obj) {
                    if ($(this).prop("checked") == true) {
                        $(this).closest("tr").find($("input[name=\"submenuview[]\"]")).attr('checked', true);
                    }
                });
            }
        }
    }

    function checkRowMenu(thiss, type) {
        if (type == 'menu') {
            if ($(thiss).prop("checked") == true) {
                var value = $(thiss).val();
                $(".rowmenu" + value).attr('checked', true);
            } else {
                var value = $(thiss).val();
                $(".rowmenu" + value).attr('checked', false);
                $(".rowmenu1").attr('checked', true);
                $(".rowmenu50").attr('checked', true);
            }
        } else if (type == 'submenu') {
            if ($(thiss).prop("checked") == true) {
                var value = $(thiss).val();
                $(".rowsubmenu" + value).attr('checked', true);
            } else {
                var value = $(thiss).val();
                $(".rowsubmenu" + value).attr('checked', false);
            }
        }
    }

    jQuery("input[name=\"menuadd[]\"]").click(function() {
        if ($(this).is(':checked')) {
            $(this).closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);
        }
    });

    jQuery("input[name=\"menuedit[]\"]").click(function() {
        if ($(this).is(':checked')) {
            $(this).closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);
        }
    });

    jQuery("input[name=\"menudelete[]\"]").click(function() {
        if ($(this).is(':checked')) {
            $(this).closest("tr").find($("input[name=\"menuview[]\"]")).attr('checked', true);
        }
    });

    $(".viewMenu").on("click", function(e) {
        if ($(this).prop("checked") == false) {
            $(this).closest("tr").find($("input[name=\"menuadd[]\"]")).attr('checked', false);
            $(this).closest("tr").find($("input[name=\"menuedit[]\"]")).attr('checked', false);
            $(this).closest("tr").find($("input[name=\"menudelete[]\"]")).attr('checked', false);
        }
    });

    /*$(".rowmenu1").on("click", function (e) {
    	var checkbox = $(this);
    	if($(this). prop("checked") == false) {
    		// do the confirmation thing here
    		e.preventDefault();
    		return false;
    	}
    });*/

    $(".rowmenu50").on("click", function(e) {
        var checkbox = $(this);
        if ($(this).prop("checked") == false) {
            // do the confirmation thing here
            e.preventDefault();
            return false;
        }
    });

    $("table").dataTable({
        "language": {
            "info": "Total Records : _TOTAL_"
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": ["_all"]
        }],
        scrollY: 500,
        scrollX: true,
        paging: false,
        filter: false,
        "order": false
    });
</script>
<script type="text/javascript">
    <?php
    if (isset($success)) { ?>
        toastr.success("Rights Saved Successfully");
    <?php } ?>
</script>0.