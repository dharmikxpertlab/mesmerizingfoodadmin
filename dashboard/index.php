<?php
$categary = "dashbord";
$pagename = "Dashbord";
include "../include/header.php";


$numberofuser = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(userId) as user FROM `user` WHERE `delete` = '0'"));
$numberoftutars = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(chefId) as chef FROM `chef` WHERE `delete` = '0'"));
$numberofappointment = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(appointmentId) as appointment FROM `appointment`"));
$numberoflivewebinars = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(chefliveId) as live FROM `cheflive` WHERE `delete` = '0' AND `status` = '1' "));

$chefonline =  mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(chefId) as 'online' FROM `chef` WHERE `delete` = '0' AND `status` = '0'"));
$chefoffline =  mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(chefId) as 'offline' FROM `chef` WHERE `delete` = '0' AND `status` = '1'"));
$chefaway = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT(chefId) as 'away' FROM `chef` WHERE `delete` = '0' AND `status` = '2'"));

$AppointmentUser = mysqli_fetch_array(mysqli_query($connection, "SELECT COUNT( DISTINCT userId) as appointmentuser FROM `appointment`"));
?>


<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class=" container ">
        <!--begin::Dashboard-->


        <!--Begin::Row-->
        <div class="row">

            <div class="col-xl-3">
                <!--begin::Stats Widget 30-->
                <div class="card card-custom bg-info card-stretch gutter-b" onclick="location.href='../users'" style="cursor: pointer;">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-2x svg-icon-white">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"><?php echo $numberofuser['user'] ?></span>
                        <span class="font-weight-bold text-white  font-size-sm">Number Of Users</span>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 30-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 31-->
                <div class="card card-custom bg-danger card-stretch gutter-b" onclick="location.href='../tutors'" style="cursor: pointer;">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24" />
                                    <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#ffffff" fill-rule="nonzero" opacity="0.3" />
                                    <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#ffffff" fill-rule="nonzero" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6 d-block"><?php echo $numberoftutars['chef']; ?></span>
                        <span class="font-weight-bold text-white  font-size-sm">Number of Tutors</span>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 31-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 32-->
                <div class="card card-custom bg-dark card-stretch gutter-b" onclick="location.href='../viewappointment'" style="cursor: pointer;">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,4 L20,4 C20.5522847,4 21,4.44771525 21,5 L21,7 C21,7.55228475 20.5522847,8 20,8 L3,8 C2.44771525,8 2,7.55228475 2,7 L2,5 C2,4.44771525 2.44771525,4 3,4 Z M10,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,13 C21,13.5522847 20.5522847,14 20,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L20,16 C20.5522847,16 21,16.4477153 21,17 L21,19 C21,19.5522847 20.5522847,20 20,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000" />
                                    <rect fill="#000000" opacity="0.3" x="2" y="10" width="5" height="10" rx="1" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6  d-block"><?php echo $numberofappointment['appointment'] ?></span>
                        <span class="font-weight-bold text-white  font-size-sm">Number Of Appointment</span>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 32-->
            </div>
            <div class="col-xl-3">
                <!--begin::Stats Widget 32-->
                <div class="card card-custom card-stretch gutter-b" onclick="location.href='../viewlivewebinars'" style="cursor: pointer; background: #1e1ead;">
                    <!--begin::Body-->
                    <div class="card-body">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path d="m40.59 49.24c-1.28 0-33.08 24.32-33.08 76 0 53.23 30.89 81.28 32.64 81.49s16.43-13.58 16.43-14.68-26.95-20.59-26.95-65.28 26.73-61.33 26.73-62.85c0-.92-12.26-14.68-15.77-14.68z" fill="#191919"/><path d="m40.29 214.77a9.09 9.09 0 0 1 -1.14-.07c-1.64-.2-4.12-.51-10.79-7.93a101.48 101.48 0 0 1 -12.11-16.87c-7.63-13.17-16.74-35.07-16.74-64.64 0-28.86 9.43-49.51 17.34-61.74a89.8 89.8 0 0 1 12.44-15.39c7-6.88 9.5-6.88 11.3-6.88 3.49 0 7.2 1.57 14.9 9.4 8.87 9 8.87 10.89 8.87 13.28 0 3.72-2.18 5.75-4.29 7.71-5.55 5.17-22.44 20.89-22.44 55.16 0 23.42 7.81 43 23.21 58.11 1.75 1.72 3.74 3.67 3.74 7.18 0 2.89 0 4.81-12.22 15.59-5.72 5.04-8.69 7.09-12.07 7.09zm.84-155.77c-7.46 7.05-25.62 28.17-25.62 66.26 0 39.53 17.7 63 25.27 71.28 1.54-1.33 3.28-2.92 4.85-4.4-15.92-17.6-24-39.56-24-65.35 0-25.52 8.06-46.81 24-63.36-1.48-1.54-3.1-3.16-4.5-4.43z" fill="#191919"/><path d="m74.77 78.6c-1.55 0-21.69 12.71-22.13 46.88-.45 35.05 19.72 52.36 21 52.58s14.24-13.36 14.24-14.46-15.48-11.84-14.68-35.49c.88-25.85 14.9-34.61 14.9-35.71s-11.36-13.8-13.33-13.8z" fill="#191919"/><path d="m73.73 186.06a8.38 8.38 0 0 1 -1.38-.12c-7.35-1.22-16.66-16.9-16.75-17.05-5.14-8.72-11.22-23.36-11-43.52.26-19.94 6.73-33.19 12.12-40.78 3.43-4.84 11.62-14 18-14 3.75 0 6.73 2 13.27 9 7.33 7.85 8.1 9.92 8.1 12.77 0 3.51-2.09 5.59-3.47 7-3 3-10.82 10.79-11.43 29a36.5 36.5 0 0 0 11.21 28.19c1.56 1.61 3.51 3.61 3.51 7s-1.46 5.38-6.84 11.14a116.63 116.63 0 0 1 -8.33 8.18c-1.34 1.19-3.74 3.19-7.01 3.19zm.68-97.53c-4.83 4.5-13.5 15.57-13.77 37-.28 21.97 8.26 35.61 13.36 41.79 1.12-1.12 2.3-2.35 3.38-3.5a51.81 51.81 0 0 1 -12.14-36c .64-18.82 7.56-30 12.45-35.83-1.06-1.16-2.22-2.39-3.28-3.46z" fill="#191919"/><path d="m215.41 49.24c1.28 0 33.08 24.32 33.08 76 0 53.23-30.89 81.28-32.64 81.49s-16.43-13.58-16.43-14.68 26.95-20.59 26.95-65.28-26.73-61.36-26.73-62.87c0-.9 12.26-14.66 15.77-14.66z" fill="#191919"/><path d="m215.7 214.77c-3.38 0-6.34-2-12.06-7.1-12.22-10.79-12.22-12.7-12.22-15.59 0-3.5 2-5.45 3.74-7.18 15.4-15.14 23.21-34.69 23.21-58.11 0-34.27-16.89-50-22.44-55.16-2.11-2-4.29-4-4.29-7.71 0-2.39 0-4.27 8.87-13.28 7.71-7.83 11.41-9.4 14.9-9.4 1.79 0 4.25 0 11.3 6.88a89.8 89.8 0 0 1 12.44 15.39c7.91 12.24 17.34 32.88 17.34 61.74 0 29.57-9.1 51.47-16.74 64.64a101.48 101.48 0 0 1 -12.11 16.86c-6.67 7.41-9.15 7.72-10.8 7.93a9 9 0 0 1 -1.14.09zm-5.33-22.62c1.56 1.48 3.31 3.07 4.85 4.4 7.57-8.23 25.27-31.75 25.27-71.28 0-38.09-18.16-59.21-25.62-66.26-1.4 1.27-3 2.89-4.48 4.43 15.91 16.55 24 37.84 24 63.36-.03 25.78-8.09 47.74-24.02 65.34z" fill="#191919"/><path d="m181.23 78.6c1.55 0 21.69 12.71 22.13 46.88.45 35.05-19.72 52.36-21 52.58s-14.24-13.36-14.24-14.46 15.48-11.84 14.68-35.49c-.88-25.85-14.9-34.61-14.9-35.71s11.36-13.8 13.33-13.8z" fill="#191919"/><path d="m182.27 186.06c-3.3 0-5.66-2-7-3.15a116.63 116.63 0 0 1 -8.33-8.18c-5.38-5.77-6.84-7.8-6.84-11.14s1.95-5.44 3.51-7a36.5 36.5 0 0 0 11.17-28.17c-.62-18.22-8.47-26.06-11.43-29-1.38-1.38-3.47-3.46-3.47-7 0-2.85.77-4.92 8.1-12.77 6.54-7 9.52-9 13.27-9 6.39 0 14.57 9.16 18 14 5.39 7.6 11.86 20.84 12.12 40.78.26 20.16-5.82 34.79-11 43.52-.09.16-9.41 15.83-16.75 17.05a8.38 8.38 0 0 1 -1.35.06zm-3.65-22.25c1.08 1.15 2.26 2.38 3.38 3.5 5.11-6.17 13.64-19.82 13.36-41.74-.27-21.48-8.94-32.54-13.77-37-1.06 1.07-2.22 2.3-3.28 3.47 4.9 5.87 11.81 17 12.45 35.83a51.81 51.81 0 0 1 -12.14 35.95z" fill="#191919"/><path d="m151.07 128.11c0 15.17-10.17 28.47-26.79 27.47-14.77-.89-26.79-12.3-26.79-27.47s10.76-27.07 26.79-27.47c15.83-.39 26.79 12.3 26.79 27.47z" fill="#191919"/><path d="m126.06 163.63q-1.12 0-2.27-.07c-19.56-1.18-34.31-16.42-34.31-35.45 0-20 14.55-35 34.59-35.47a33.24 33.24 0 0 1 24.35 9.36 36.5 36.5 0 0 1  10.65 26.09c0 10.56-4 20.4-11 27a31.37 31.37 0 0 1 -22.01 8.54zm-1.07-55h-.52c-11.18.28-19 8.29-19 19.47 0 10.44 8.29 18.82 19.27 19.48a15.85 15.85 0 0 0 12.33-4.15c3.8-3.58 6-9.17 6-15.34a20.43 20.43 0 0 0 -5.82-14.64 17.14 17.14 0 0 0 -12.25-4.82z" fill="#191919"/><path d="m40.59 49.24c-1.28 0-33.08 24.32-33.08 76 0 53.23 30.89 81.28 32.64 81.49s16.43-13.58 16.43-14.68-26.95-20.59-26.95-65.28 26.73-61.33 26.73-62.85c0-.92-12.26-14.68-15.77-14.68z" fill="#fff"/><path d="m74.77 78.6c-1.55 0-21.69 12.71-22.13 46.88-.45 35.05 19.72 52.36 21 52.58s14.24-13.36 14.24-14.46-15.48-11.84-14.68-35.49c.88-25.85 14.9-34.61 14.9-35.71s-11.36-13.8-13.33-13.8z" fill="#fff"/><path d="m215.41 49.24c1.28 0 33.08 24.32 33.08 76 0 53.23-30.89 81.28-32.64 81.49s-16.43-13.58-16.43-14.68 26.95-20.59 26.95-65.28-26.73-61.36-26.73-62.87c0-.9 12.26-14.66 15.77-14.66z" fill="#fff"/><path d="m181.23 78.6c1.55 0 21.69 12.71 22.13 46.88.45 35.05-19.72 52.36-21 52.58s-14.24-13.36-14.24-14.46 15.48-11.84 14.68-35.49c-.88-25.85-14.9-34.61-14.9-35.71s11.36-13.8 13.33-13.8z" fill="#fff"/><path d="m151.07 128.11c0 15.17-10.17 28.47-26.79 27.47-14.77-.89-26.79-12.3-26.79-27.47s10.76-27.07 26.79-27.47c15.83-.39 26.79 12.3 26.79 27.47z" fill="#e83a2a"/></svg>
                            <!--end::Svg Icon-->
                        </span>
                        <span class="card-title font-weight-bolder text-white font-size-h2 mb-0 mt-6  d-block"><?php echo $numberoflivewebinars['live'] ?></span>
                        <span class="font-weight-bold text-white  font-size-sm">Number Of Live Webinars </span>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Stats Widget 32-->
            </div>
        </div>
        <!--End::Row-->


        <div class="row">
            
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">
                                Tutors Status
                            </h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin::Chart-->
                        <div id="chart_12" class="d-flex justify-content-center"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>

        <div class="row">
    
    <div class="col-xl-4">
                <!--begin::Mixed Widget 18-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <div class="card-title font-weight-bolder">
                    <div class="card-label">
                        Most used service
                        <div class="font-size-sm text-muted mt-2"></div>
                    </div>
                </div>
                
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body mt-10 mb-5">
                <!--begin::Chart-->
                <!-- <div id="kt_mixed_widget_18_chart" style="height: 250px"></div> -->
                <!--end::Chart-->

                <!--begin::Items-->
                <div class="mt-n12 position-relative zindex-0 ">
                    
                    <!--begin::Widget Item-->
                    <div class="d-flex align-items-center mb-8">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-gray-500"><!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-pie.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
                <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
            </g>
        </svg><!--end::Svg Icon--></span>                    </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Appointment</a>
                            <div class="font-size-sm text-muted font-weight-bold mt-1"><?php echo $AppointmentUser['appointmentuser'];?> Users</div>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Widget Item-->

                    <!--begin::Widget Item-->
                    <div class="d-flex align-items-center">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-gray-500"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"/>
                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
            </g>
        </svg><!--end::Svg Icon--></span>                    </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Cources</a>
                            <div class="font-size-sm text-muted font-weight-bold mt-1">7 Users</div>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Widget Item-->
                </div>
                <!--end::Items-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 18-->
    </div>
    <div class="col-xl-4">
                <!--begin::Mixed Widget 18-->
        <div class="card card-custom gutter-b card-stretch">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <div class="card-title font-weight-bolder">
                    <div class="card-label">
                    Total users by each service
                        <div class="font-size-sm text-muted mt-2"></div>
                    </div>
                </div>
                
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body mt-10 mb-5">
                <!--begin::Chart-->
                <!-- <div id="kt_mixed_widget_18_chart" style="height: 250px"></div> -->
                <!--end::Chart-->

                <!--begin::Items-->
                <div class="mt-n12 position-relative zindex-0 ">
                    
                    <!--begin::Widget Item-->
                    <div class="d-flex align-items-center mb-8">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-gray-500"><!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-pie.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M4.00246329,12.2004927 L13,14 L13,4.06189375 C16.9463116,4.55399184 20,7.92038235 20,12 C20,16.418278 16.418278,20 12,20 C7.64874861,20 4.10886412,16.5261253 4.00246329,12.2004927 Z" fill="#000000" opacity="0.3"/>
                <path d="M3.0603968,10.0120794 C3.54712466,6.05992157 6.91622084,3 11,3 L11,11.6 L3.0603968,10.0120794 Z" fill="#000000"/>
            </g>
        </svg><!--end::Svg Icon--></span>                    </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Appointment</a>
                            <div class="font-size-sm text-muted font-weight-bold mt-1"><?php echo $AppointmentUser['appointmentuser'];?> Users</div>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Widget Item-->

                    <!--begin::Widget Item-->
                    <div class="d-flex align-items-center mb-8">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-gray-500"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"/>
                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
            </g>
        </svg><!--end::Svg Icon--></span>                    </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Cources</a>
                            <div class="font-size-sm text-muted font-weight-bold mt-1">7 Users</div>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Widget Item-->

                    <!--begin::Widget Item-->
                    <div class="d-flex align-items-center mb-8">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-gray-500"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"/>
                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
            </g>
        </svg><!--end::Svg Icon--></span>                    </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Diet Plan</a>
                            <div class="font-size-sm text-muted font-weight-bold mt-1">7 Users</div>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Widget Item-->

                    <!--begin::Widget Item-->
                    <div class="d-flex align-items-center mb-8">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-lg svg-icon-gray-500"><!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24"/>
                <path d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z" fill="#000000" fill-rule="nonzero"/>
                <path d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z" fill="#000000" opacity="0.3"/>
            </g>
        </svg><!--end::Svg Icon--></span>                    </div>
                        </div>
                        <!--end::Symbol-->

                        <!--begin::Title-->
                        <div>
                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Live webinars</a>
                            <div class="font-size-sm text-muted font-weight-bold mt-1">7 Users</div>
                        </div>
                        <!--end::Title-->
                    </div>
                    <!--end::Widget Item-->
                </div>
                <!--end::Items-->
                
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 18-->
    </div>
</div>
<!--end::Row-->

    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->








<?php
include "../include/footer.php";
?>


<script>
    

        // Shared Colors Definition
        const primary = '#6993FF';
        const success = '#1BC5BD';
        const info = '#8950FC';
        const warning = '#FFA800';
        const danger = '#F64E60';


        const apexChart = "#chart_12";
        var options = {
            series: [<?php echo $chefonline['online'];?>,<?php echo $chefoffline['offline'];?>, 0, <?php echo $chefaway['away'];?>],
            chart: {
                width: 500,
                type: 'pie',
            },
            labels: ['Online', 'Offline', 'On-call', '3 months Away',],
            responsive: [{
                breakpoint: 10,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }],
            colors: [primary, success, warning, danger]
        };

        var chart = new ApexCharts(document.querySelector(apexChart), options);
        chart.render();

</script>
<!-- <script src="../assets/js/pages/features/charts/apexcharts.js"></script> -->