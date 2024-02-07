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

<?php
if ($_GET['do'] == 'admin') {
  echo '<script tpye="text/javascript">
  Swal.fire({icon: "success",title: "เข้าสู่ระบบเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
  </script>';
  echo '<meta http-equiv="refresh" content="2;url=admin_page.inc.php">';
}


?>
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
                <i class="fal fa-user-cog text-center m-md-6 " style="font-size: 30px;"> ยินดีต้อนรับสู่ระบบ Admin_page
            <br>
            <br>
           <span  style="color: #f28211;">
            คุณ <?php echo $_SESSION['m_username']; ?>
            </span>
        </i>

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