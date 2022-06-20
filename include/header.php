<?php include '../include/dbConnection.php'; ?>
<?php
if (!isset($_SESSION['admin'])) {
    header("Location:../");
}
if (isset($_SESSION['admin'])) {
    $adminQuery = mysqli_query($connection, "SELECT * FROM `admin` WHERE `adminId`={$_SESSION['admin']}") or die("Unsuccessful");
    $adminData = mysqli_fetch_array($adminQuery);
    $adminName = $adminData['adminName'];
}

$roleId = $adminData['roleId'];

$assignedmenuadd = array();
$assignedmenuview = array();
$assignedmenuedit = array();
$assignedmenudelete = array();

$role = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM `role` WHERE `roleId` = '{$roleId}'"));

$assignedmenuadd = explode(",", $role['menuIdAdd']);
$assignedmenuview = explode(",", $role['menuIdView']);
$assignedmenuedit = explode(",", $role['menuIdEdit']);
$assignedmenudelete = explode(",", $role['menuIdDelete']);
// print_r($assignedmenuview);
// print_r($assignedmenuadd);
//  if(!(in_array(24, $assignedmenuedit))
//  if(in_array($pageId,$assignedmenuadd)){

//  }
//print_r($assignedmenuadd);
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>

    <meta charset="utf-8" />
    <title>Mesmerizing Food | <?php if (isset($pagename)) {
                echo $pagename;
            } else {
                echo "Dashboard";
            } ?></title>
    <link href="../images/mesmerizing.png" rel="shortcut icon" type="image/x-icon">
    <meta name="description" content="Updates and statistics" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <link href="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendors Styles-->


    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="../assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <link href="../assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <!-- custom links -->
    <!-- <link href="../assets/plugins/custom/cropper/cropper.bundle.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://foliotek.github.io/Croppie/croppie.css" />
    <link rel="shortcut icon" href="../images/logo.jpg" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="../assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        .apac-grad {

            background-image: linear-gradient(#023047, #1f8abf);
            color: white;
        }

        .apac-btn {
            background-color: #023047;
            margin-top: 10%;
            height: 50%;
            width: 20px;

        }

        .error {
            color: red !important;
        }

        .preloader {
            background-image: linear-gradient(to right, #0071CD 0%, #003967 51%, #0071CD 100%);
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            color: white;
            position: fixed;
            width: 100%;
            height: 100%;
            z-index: 99999;
            text-align: center;
            top: 0;
            left: 0;
            overflow: hidden;
        }

        .spinner-grow {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: -0.125em;
            background-color: currentColor;
            border-radius: 50%;
            opacity: 0;
            -webkit-animation: 0.5s linear infinite spinner-grow;
            animation: 0.5s linear infinite spinner-grow;
        }

        .visually-hidden,
        .visually-hidden-focusable:not(:focus):not(:focus-within) {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            margin: -1px !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }
    </style>

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed subheader-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center  header-mobile-fixed ">
        <!--begin::Logo-->
        <a href="../dashboard/" class="brand-logo">
            <span>Mesmorizing Food</span>
        </a>
        <!--end::Logo-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Aside Mobile Toggle-->
            <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
                <span></span>
            </button>
            <!--end::Aside Mobile Toggle-->

            <!--begin::Header Menu Mobile Toggle-->
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <!--end::Header Menu Mobile Toggle-->

            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span> </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">

            <!--begin::Aside-->
            <div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
                <!--begin::Brand-->
                <div class="brand flex-column-auto " id="kt_brand">
                    <!--begin::Logo-->
                    <a href="../dashboard/" class="brand-logo">
                        <!-- <img alt="Logo" src="../images/logo.jpg"/> -->
                        <span>Mesmorizing Food</span>
                    </a>
                    <!--end::Logo-->

                    <!--begin::Toggle-->
                    <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                        <span class="svg-icon svg-icon svg-icon-xl">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
                                    <path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span> </button>
                    <!--end::Toolbar-->
                </div>
                <!--end::Brand-->

                <!--begin::Aside Menu-->
                <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                    <!--begin::Menu Container-->
                    <div id="kt_aside_menu" class="aside-menu my-4 " data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
                        <!--begin::Menu Nav-->
                        <ul class="menu-nav ">

                            <?php
                            $menu = mysqli_query($connection, "SELECT * FROM `menu` WHERE `mainMenuId` = '0' AND `deleteMenu` = '0' ORDER BY `order` ASC");
                            if (mysqli_num_rows($menu) > 0) {
                                while ($menuRow = mysqli_fetch_array($menu)) {


                                    $submenuData = mysqli_query($connection, "SELECT * FROM `menu` WHERE `mainMenuId`='" . $menuRow['menuId'] . "' AND `deleteMenu` = '0' AND `visibility` = '' ORDER BY `order` ASC");

                                    $menuCount = mysqli_num_rows($submenuData);

                                    if (in_array($menuRow['menuId'], $assignedmenuview)) {

                            ?>
                                        <li class="menu-item   <?php if ($menuCount > 0) {
                                                                    echo 'menu-item-submenu';
                                                                }  ?>" <?php if ($menuCount > 0) {
                                                                        echo 'data-menu-toggle="hover"';
                                                                    } ?>aria-haspopup="true">
                                            <div class="menu-link <?php if ($menuCount > 0) {
                                                                        echo 'menu-toggle';
                                                                    } ?> "><span class="svg-icon menu-icon">
                                                    <span class="material-icons">
                                                        <?php echo $menuRow['icon']; ?>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span><span class="menu-text"><a href="<?php echo $menuRow['path']; ?>"><?php echo $menuRow['menuName']; ?></a></span> <?php
                                                                                                                                                                        if ($menuCount > 0) {
                                                                                                                                                                        ?>
                                                    <span class="menu-arrow"></span>
                                                    <?php
                                                                                                                                                                        } elseif ($menuRow['add'] == 'YES') {
                                                                                                                                                                            if (in_array($menuRow['menuId'], $assignedmenuadd)) {
                                                    ?><span class="brand-logo">
                                                            <a href="<?php echo $menuRow['addPath']; ?>" class=""><span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                            <rect x="0" y="0" width="24" height="24" />
                                                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                            <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span></span></a>
                                                <?php }
                                                                                                                                                                        } ?>
                                            </div>

                                            <div class="menu-submenu" <?php if (isset($pageId)) {
                                                                            if ($pageId == 1) {
                                                                                echo "";
                                                                            } else {
                                                                                echo 'style="display: none; overflow: hidden;"';
                                                                            }
                                                                        } ?>><i class="menu-arrow"></i>
                                                <?php
                                                if ($menuCount > 0) { ?>
                                                    <ul class="menu-subnav">
                                                        <?php

                                                        while ($subMenuRow = mysqli_fetch_array($submenuData)) {
                                                            if (in_array($subMenuRow['menuId'], $assignedmenuview)) {
                                                        ?>
                                                                <li class="menu-item " aria-haspopup="true">
                                                                    <div class="menu-link "><i class="menu-bullet menu-bullet-dot"><span></span></i><span class="menu-text"><a href="<?php echo $subMenuRow['path']; ?>"><?php echo $subMenuRow['menuName'] ?></a></span>
                                                                        <?php
                                                                        if ($subMenuRow['add'] == 'YES') {
                                                                            if (in_array($subMenuRow['menuId'], $assignedmenuadd)) {
                                                                        ?><span class="brand-logo" style="margin-top: 6px;">
                                                                                    <a href="<?php echo $subMenuRow['addPath']; ?>"><span class="svg-icon svg-icon-primary svg-icon-2x">
                                                                                            <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10" />
                                                                                                    <path d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z" fill="#000000" />
                                                                                                </g>
                                                                                            </svg>
                                                                                            <!--end::Svg Icon-->
                                                                                        </span></span></a>
                                                                        <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </li>

                                                        <?php
                                                            }
                                                        }

                                                        ?>
                                                    </ul>


                                            </div>
                                        <?php } ?>
                                        </li>
                            <?php  }
                                }
                            }
                            ?>
                        </ul>
                        <!--end::Menu Nav-->
                    </div>
                    <!--end::Menu Container-->
                </div>
                <!--end::Aside Menu-->
            </div>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header  header-fixed ">
                    <!--begin::Container-->
                    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">

                        </div>
                        <!--end::Header Menu Wrapper-->

                        <!--begin::Topbar-->
                        <div class="topbar">
                            <!--begin::User-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
                                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?php if (isset($adminName)) {
                                                                                                                                echo ucfirst($adminName);
                                                                                                                            } ?></span>
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                        <?php if ($adminData['profile'] == "") {
                                            $adminData['profile'] = "blank.png";
                                        } ?>
                                        <span class="symbol-label font-size-h5 font-weight-bold"><img height="40px" width="40px" style="border-radius: 5px;" src="../images/<?php echo $adminData['profile']; ?>" alt="" srcset=""></span>
                                    </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-4  subheader-solid " id="kt_subheader">
                        <div class=" container-fluid  d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                            <div class="d-flex align-items-center flex-wrap mr-2">

                                <!--begin::Page Title-->
                                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                                    <?php if (isset($pageName)) {
                                        echo $pageName;
                                    } ?> </h5>
                                <!--end::Page Title-->

                                <!--begin::Actions-->
                                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200">
                                </div>

                                <span class="text-muted font-weight-bold mr-4" id="edittoview"><?php if (isset($subPage)) {
                                                                                                    echo $subPage;
                                                                                                } ?></span>
                                <!--end::Actions-->
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Subheader-->
                    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10 ">
                        <!--begin::Header-->
                        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5" kt-hidden-height="40">
                            <h3 class="font-weight-bold m-0">
                                User Profile
                            </h3>
                            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </a>
                        </div>
                        <!--end::Header-->

                        <!--begin::Content-->
                        <div class="offcanvas-content pr-5 mr-n5 scroll ps ps--active-y" style="height: 186px; overflow: hidden;">
                            <!--begin::Header-->
                            <div class="d-flex align-items-center mt-5">
                                <div class="symbol symbol-100 mr-5">
                                    <div class="symbol-label" style="background-image:url('../images/<?php echo $adminData['profile']; ?>')"></div>
                                </div>
                                <div class="d-flex flex-column">
                                    <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                                        <?php echo ucfirst($adminData['adminName']);?>
                                    </a>
                                    <div class="text-muted mt-1">

                                    </div>
                                    <div class="navi mt-2">
                                        <a href="#" class="navi-item">
                                            <span class="navi-link p-0 pb-2">
                                                <span class="navi-icon mr-1">
                                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000"></path>
                                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"></circle>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span> </span>
                                                <span class="navi-text text-muted text-hover-primary"><?php echo $adminData['email']; ?></span>
                                            </span>
                                        </a>

                                        <a href="../logout/index.php" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Sign Out</a>
                                    </div>
                                </div>
                            </div>
                            <!--end::Header-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed mt-8 mb-5"></div>
                            <!--end::Separator-->

                            <!--begin::Nav-->
                            <div class="navi navi-spacer-x-0 p-0">
                                <!--begin::Item-->
                                <a href="../profile/" class="navi-item">
                                    <div class="navi-link">
                                        <div class="symbol symbol-40 bg-light mr-3">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-md svg-icon-success">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"></rect>
                                                            <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000"></path>
                                                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"></circle>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <div class="navi-text">
                                            <div class="font-weight-bold">
                                                My Profile
                                            </div>
                                            <div class="text-muted">
                                                Account settings and more

                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!--end:Item-->


                            </div>
                            <!--end::Nav-->


                        </div>
                        <!--end::Content-->
                    </div>

                    <!-- <div class="preloader" id="preloader">
                        <div class="spinner-grow" role="status">
                            <span class="visually-hidden"></span>
                        </div>
                    </div> -->