<?php include_once('admin_head.inc.php');?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_Member
    </title>
  
    <?php include('admin_linkon.inc.php');?>
    
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
            <aside class="page-sidebar ">
                <div class="page-logo ">
                    <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                        <img src="img/cart.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                        <span class="page-logo-text mr-1 text-info">E-COMMERCE</span>
                        <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>

                    </a>
                </div>
                <!-- BEGIN PRIMARY NAVIGATION -->
               
                <?php include('admin_menu_l.inc.php');?>

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <?php include('admin_menu_r.inc.php');?>

                <main id="js-page-content" role="main" class="page-content">
                <i class="fal fa-chart-bar text-center m-md-6 " style="font-size: 30px;"> รายงานยอดการขายสินค้า </i>
                <div class="row">
                    <a href="admin_report.inc.php" class="btn btn-outline-warning m-md-1 px-4"><b>รายวัน</b></a>
                    <a href="admin_report.inc.php?act=m" class="btn btn-outline-success m-md-1 px-4"><b>รายเดือน</b> </a>
                    <a href="admin_report.inc.php?act=y" class="btn btn-outline-info m-md-1 px-5"><b> รายปี</b></a>
                    <a href="admin_report.inc.php?act=rangedate" class="btn btn-outline-primary m-md-1 px-2"><b>เรียกดูตามวัน</b></a> 
                    </div>
                    <?php
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');
                    if ($act == 'm') {
                        include 'report_m.php';
                    } elseif ($act == 'y') {
                        include 'report_y.php';
                    } elseif ($act == 'date') {
                        include 'report_d.php';
                    } elseif ($act == 'rangedate') {
                        include 'report_rangedate.php';
                    } else {
                        include 'report_d.php';
                    }
                    ?>

                     </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <?php include('admin_footer.inc.php'); ?>

                <?php include('admin_setting.inc.php');?>
      

    <script src="js/vendors.bundle.js"></script>
    <script src="js/app.bundle.js"></script>
    
    
   
</body>
<!-- END Body -->

</html>