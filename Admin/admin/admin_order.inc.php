<?php
include_once('../connect/conndb.php');
include_once('admin_head.inc.php');
$querystatus1 =
    "SELECT o_status, COUNT(o_id) as s1total FROM order_head WHERE o_status=1 GROUP BY o_status";
$rs1 = mysqli_query($conn, $querystatus1);
$rows1 = mysqli_fetch_array($rs1);

//query status = 2
$querystatus2 =
    "SELECT o_status, COUNT(o_id) as s2total FROM order_head WHERE o_status=2 GROUP BY o_status";
$rs2 = mysqli_query($conn, $querystatus2);
$rows2 = mysqli_fetch_array($rs2);

//query status = 3
$querystatus3 =
    "SELECT o_status, COUNT(o_id) as s3total FROM order_head WHERE o_status=3 GROUP BY o_status";
$rs3 = mysqli_query($conn, $querystatus3);
$rows3 = mysqli_fetch_array($rs3);

//query status = 4
$querystatus4 =
    "SELECT o_status, COUNT(o_id) as s4total FROM order_head WHERE o_status=4 GROUP BY o_status";
$rs4 = mysqli_query($conn, $querystatus4);
$rows4 = mysqli_fetch_array($rs4);

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_Member
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
                    <i class="fal fa-cart-arrow-down text-center m-md-6 " style="font-size: 30px;"> รายการออเดอร์สินค้า</i>
                    <div class="row">
                    <a href="admin_order.inc.php" class="btn btn-outline-warning m-md-1 px-1"><b>รอชำระเงิน</b>  <span class="badge badge-warning"><b><?php echo $rows1['s1total']; ?></b></span> </a>
                    <a href="admin_order.inc.php?act=paid" class="btn btn-outline-success m-md-1 px-1"><b> ชำระเงินแล้ว</b> <span class="badge badge-success"><?php echo $rows2['s2total']; ?></span> </a>
                    <a href="admin_order.inc.php?act=ems" class="btn btn-outline-info m-md-1 px-1"><b> แจ้งเลข Ems</b> <span class="badge badge-info"><?php echo $rows3['s3total']; ?></span></a>
                    <a href="admin_order.inc.php?act=cancel" class="btn btn-outline-danger m-md-1 px-3"><b> ยกเลิก</b> <span class="badge badge-danger"><?php echo $rows4['s4total']; ?></span></a> 
                    </div>
                    <br>
                   <?php
                   
                    //รอชำระเงิน
                    $act = (isset($_GET['act']) ? $_GET['act'] : '');

                    if ($act == 'paid') {
                        include 'list_order_paid.php';
                    } elseif ($act == 'ems') {
                        include 'list_order_ems.php';
                    } elseif ($act == 'cancel') {
                        include 'list_order_cancel.php';
                    } else {
                        include 'list_order_new.php';
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
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

                    $('.btn-del').click(function(e) {
                        // var userId = $(this).data('t_id');
                        e.preventDefault();
                        const href = $(this).attr('href')

                        Swal.fire({
                            title: 'คุณต้องการลบประเภทสินค้านี้หรือไม่?',
                            text: 'ถ้าลบแล้วจะไม่สามารถกู้คืนได้ !',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่, ลบเลย !',
                            cancelButtonText: 'ยกเลิก',
                        }).then((result) => {
                            if (result.value) {
                                document.location.href = href;
                            }
                        })

                    })
                </script>


</body>
<!-- END Body -->

</html>