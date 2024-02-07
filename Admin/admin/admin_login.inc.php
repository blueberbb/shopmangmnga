<?php
include('admin_head.inc.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_Login
    </title>
    <?php include('admin_linkon.inc.php'); ?>
</head>


<body class="mod-bg-1 mod-nav-link ">

    <!-- DOC: script to save and load page settings -->
    <script>
        'use strict';

        var classHolder = document.getElementsByTagName("BODY")[0],
            /** 
             * Load from localstorage
             **/
            themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) : {},
            themeURL = themeSettings.themeURL || '',
            themeOptions = themeSettings.themeOptions || '';
        /** 
         * Load theme options
         **/
        if (themeSettings.themeOptions) {
            classHolder.className = themeSettings.themeOptions;
            console.log("%c✔ Theme settings loaded", "color: #148f32");
        } else {
            console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
        }
        if (themeSettings.themeURL && !document.getElementById('mytheme')) {
            var cssfile = document.createElement('link');
            cssfile.id = 'mytheme';
            cssfile.rel = 'stylesheet';
            cssfile.href = themeURL;
            document.getElementsByTagName('head')[0].appendChild(cssfile);

        } else if (themeSettings.themeURL && document.getElementById('mytheme')) {
            document.getElementById('mytheme').href = themeSettings.themeURL;
        }
        /** 
         * Save to localstorage 
         **/
        var saveSettings = function() {
            themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item) {
                return /^(nav|header|footer|mod|display)-/i.test(item);
            }).join(' ');
            if (document.getElementById('mytheme')) {
                themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
            };
            localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
        }
        /** 
         * Reset settings
         **/
        var resetSettings = function() {
            localStorage.setItem("themeSettings", "");
        }
    </script>
    <!-- BEGIN Page Wrapper -->
    <div class="page-wrapper">
        <div class="page-inner">
            <!-- BEGIN Left Aside -->
            <aside class="page-sidebar">
                <div class="page-logo">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                        <img src="img/cart.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                        <span class="page-logo-text mr-1 text-info">E-COMMERCE</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>

                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
                <?php include('admin_menu_l.inc.php'); ?>


            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <header class="page-header" role="banner">
                    <!-- we need this logo when user switches to nav-function-top -->

                    <!-- DOC: nav menu layout change shortcut -->
                    <div class="hidden-md-down dropdown-icon-menu position-relative">
                        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                            <i class="ni ni-menu"></i>
                        </a>
                        <ul>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                    <i class="ni ni-minify-nav"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                    <i class="ni ni-lock-nav"></i>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="hidden-lg-up">
                        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                            <i class="ni ni-menu"></i>
                        </a>
                    </div>

                    <div class="ml-auto d-flex">



                        <!-- app user menu -->
                        <div>
                            <a href="#" data-toggle="dropdown" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                <img src="../profile/<?php echo $_SESSION['m_img']; ?>" style="width: 40px;height: 40px;" class="cursor-pointer profile-image rounded-circle" >

                            </a>
                            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                        <span class="mr-2">
                                            <img src="../profile/<?php echo $_SESSION['m_img']; ?>" style="width: 40px;height: 40px;" class=" cursor-pointer rounded-circle profile-image">
                                            <!--ตำแหน่งเปลี่ยนรูปโปรไฟล์-->
                                        </span>
                                        <div class="info-card-text">
                                            <div class="fs-lg text-truncate text-truncate-lg"></div>
                                            <!-- <span class="text-truncate text-truncate-md opacity-80">drlantern@gotbootstrap.com</span> -->
                                        </div>
                                    </div>
                                </div>

                                <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                    <span data-i18n="drpdwn.settings">ตั้งค่าระบบ</span>
                                </a>

                                <div class="dropdown-divider m-0"></div>
                                <a class="dropdown-item fw-500 pt-3 pb-3" href="admin_logout.inc.php" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่?');">
                                    <span data-i18n="drpdwn.page-logout">ออกจากระบบ</span>
                                    <span class="float-right fw-n"><?php echo $_SESSION['m_username']; ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </header>

                <main id="js-page-content" role="main" class="page-content">
                    <i class="fal fa-sign-in-alt text-center m-md-3" style="font-size: 25px;"> ประวัติการ Login</i>
                    <div class="container text-center">
                        <div class="form-row">
                            <div class="col-12">
                                <form id="js-login" class="from-horizontal" method="get" name="q" action="">
                                    <div class=" col-sm-3" style=" margin:auto;width:90%;">
                                        <label for="ds">วันที่เริ่ม</label>
                                        <input type="date" name="ds" class="form-control text-center" required>
                                        
                                    </div>

                                        <div class=" col-sm-3" style=" margin:auto;width:90%;">
                                        <label for="de">วันที่สิ้นสุด</label>
                                        <input type="date" name="de" class="form-control text-center" required>
                                       
                                    </div>
                                    <br>
                                    <div >
                                    <button type="submit" name="act" class="btn btn-primary btn-sm" value="day"><i class="fal fa-search"></i> ค้นหาข้อมูลระหว่างวัน</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <p>
                        <a href="admin_login.inc.php?act=log_login" class="btn btn-success btn-sm py-1 m-1 px-3">จำนวน (ครั้ง)</a>
                        <a href="admin_login.inc.php?act=day" class="btn btn-primary btn-sm py-1 m-1  px-3">ช่วงวัน-เวลา</a>
                        <a href="admin_login.inc.php?act=monthly" class="btn btn-info btn-sm py-1 m-1  px-3">เดือน (ครั้ง)</a>
                        <a href="admin_login.inc.php" class="btn btn-warning btn-sm py-1 m-1  px-4">ปี (ครั้ง)</a>
                    </p>

                 <?php
                 $act = (isset($_GET['act']) ? $_GET['act'] : '');
                 if($act=='log_login'){
                     include('admin_login_by_user.inc.php');
                 }elseif($act=='day'){
                    include('admin_login_by_day.inc.php');
                 }elseif($act=='monthly'){
                    include('admin_login_by_monthly.inc.php');
                 }else{
                    include('admin_login_by_year.inc.php');
                 }
                 ?>
                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
               
                <?php include('admin_footer.inc.php'); ?>
                <?php include('admin_setting.inc.php'); ?>


                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>
                <script src="js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
                <script src="js/datagrid/datatables/datatables.bundle.js"></script>
                <script src="js/datagrid/datatables/datatables.export.js"></script>

                <script>
                    $(document).ready(function() {

                        // initialize datatable
                        $('#dt-basic-example').dataTable({
                            responsive: true,
                            lengthChange: false,
                            dom:

                                "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                                "<'row'<'col-sm-12'tr>>" +
                                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                            buttons: [

                                {
                                    extend: 'pdfHtml5',
                                    text: 'PDF',
                                    titleAttr: 'Generate PDF',
                                    className: 'btn-outline-danger btn-sm mr-1'
                                },
                                {
                                    extend: 'excelHtml5',
                                    text: 'Excel',
                                    titleAttr: 'Generate Excel',
                                    className: 'btn-outline-success btn-sm mr-1'
                                },
                                {
                                    extend: 'csvHtml5',
                                    text: 'CSV',
                                    titleAttr: 'Generate CSV',
                                    className: 'btn-outline-warning btn-sm mr-1'
                                },
                                {
                                    extend: 'copyHtml5',
                                    text: 'Copy',
                                    titleAttr: 'Copy to clipboard',
                                    className: 'btn-outline-secondary btn-sm mr-1'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    titleAttr: 'Print Table',
                                    className: 'btn-outline-info btn-sm'
                                }
                            ]
                        });

                    });

                    $("#js-add-btn").click(function(event) {

                        // Fetch form to apply custom Bootstrap validation
                        var form = $("#js-login")

                        if (form[0].checkValidity() === false) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.addClass('was-validated');
                        // Perform ajax submit here...
                    });
                </script>


</body>
<!-- END Body -->

</html>