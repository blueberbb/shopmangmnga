<?php
include_once('admin_head.inc.php');
include_once('../connect/conndb.php');

$query = "SELECT
COUNT(c_id) AS total, DATE_FORMAT(c_datesave, '%Y') AS datesave
FROM tbl_counter
GROUP BY DATE_FORMAT(c_datesave, '%y%')
ORDER BY DATE_FORMAT(c_datesave, '%Y-%m-%d') DESC
";
$result = mysqli_query($conn, $query);
$resultchart = mysqli_query($conn, $query);

// echo $query;

//for chart
$datesave = array();
$total = array();
while ($rs = mysqli_fetch_array($resultchart)) {
    $datesave[] = "\"" . $rs['datesave'] . "\"";
    $total[] = "\"" . $rs['total'] . "\"";
}
$datesave = implode(",", $datesave);
$total = implode(",", $total);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_VIEW
    </title>

    <?php include('admin_linkon.inc.php'); ?>

</head>


<body class="mod-bg-1 mod-nav-link " style="font-family: 'Prompt', sans-serif;">

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

                <?php include('admin_menu_l.inc.php'); ?>

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <?php include('admin_menu_r.inc.php'); ?>

                <main id="js-page-content" role="main" class="page-content">
                    
                    <h2 align="center">รายงานยอดผู้เข้าชมเว็บไซต์</h2>
                    <p>
          <a href="admin_counter.inc.php" class="btn btn-info"><i class="fal fa-users-class"></i> ตามวัน </a> 

          <a href="admin_counter_m.inc.php" class="btn btn-primary"><i class="fal fa-users-class"></i> ตามเดือน </a> 

          <a href="admin_counter_y.inc.php" class="btn btn-warning"><i class="fal fa-users-class"></i> ตามปี </a> 
         

        </p>


                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
                    <hr>
                    <p align="center">
                        <!--devbanban.com-->
                        <canvas id="myChart" width="800px" height="300px"></canvas>
                        <script>
                            var ctx = document.getElementById("myChart").getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [<?php echo $datesave; ?>],
                                    datasets: [{
                                        label: 'รายงานแยกตามปี',
                                        data: [<?php echo $total; ?>],
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)',
                                            'rgba(75, 192, 192, 0.2)',
                                            'rgba(153, 102, 255, 0.2)',
                                            'rgba(255, 159, 64, 0.2)'
                                        ],
                                        borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            'rgba(255, 159, 64, 1)'
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                        </script>
                    </p>

                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <?php include('admin_footer.inc.php'); ?>

                <?php include('admin_setting.inc.php'); ?>


                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>



</body>
<!-- END Body -->

</html>