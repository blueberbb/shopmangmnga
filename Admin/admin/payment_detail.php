<?php

include('admin_head.inc.php');
include_once('../connect/conndb.php');

// print_r($_SESSION);


$o_id = mysqli_real_escape_string($conn, $_GET['o_id']);


$querycartdetail =
    "SELECT d.*,p.p_img, p.p_name, p.p_price, h.*, b.bname, b.bnumber
FROM order_detail as d
INNER JOIN order_head as h ON d.o_id = h.o_id
INNER JOIN tbl_prd as p ON d.p_id = p.p_id
INNER JOIN tbl_bank as b ON h.bid = b.bid
WHERE d.o_id=$o_id


";
$rscartdetail = mysqli_query($conn, $querycartdetail);
$rowdetail = mysqli_fetch_array($rscartdetail); //css 

$querybank = "SELECT * FROM tbl_bank ";
$rsbank = mysqli_query($conn, $querybank);


?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Member_order
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
                        <span class="page-logo-text mr-1">E-COMMERCE</span>
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
                    <div class="col-12">
                    <h3 class="font-weight-bold "> แจ้งชำระเงิน</h3>
                        <h4>
                            OrderId : <?php echo $rowdetail['o_id']; ?><br>
                            ส่งไปที่ : <?php echo $rowdetail['o_name']; ?> <br>
                            <?php echo $rowdetail['o_addr']; ?><br>
                            เบอร์โทร : <?php echo $rowdetail['o_phone']; ?>,
                            Email : <?php echo $rowdetail['o_email']; ?><br>
                            วันที่สั่งซื้อ : <?php echo $rowdetail['o_dttm']; ?><br>
                            สถานะ : <?php
                                    $st = $rowdetail['o_status'];
                                    echo '<font color="#00eaff">';
                                    if ($st == 1) {
                                        echo 'รอชำระเงิน';
                                    } elseif ($st == 2) {
                                        echo 'ชำระเงินแล้ว';
                                    } elseif ($st == 3) {
                                        echo 'ตรวจสอบเลข EMS';
                                    } else {
                                        echo 'ยกเลิก';
                                    }
                                    echo '</font>';


                                    // 1= รอชำระเงิน 2= ชำระเงินแล้ว 3= ตรวจสอบเลข EMS 4= ยกเลิก	
                                    ?>

                        </h4>
                        <div style='overflow-x:auto; font-size: 15px;'>
                            <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
                                <thead class="bg-primary-600">
                                    <tr>
                                        <th width="5%">
                                            <center>#</center>
                                        </th>
                                        <th width="5%">
                                            <center>img</center>
                                        </th>
                                        <th width="50%">
                                            <center>สินค้า</center>
                                        </th>
                                        <th width="10%">
                                            <center>ราคา</center>
                                        </th>
                                        <th width="10%">
                                            <center>จำนวน</center>
                                        </th>
                                        <th width="5%" " >
                                    <center>รวม(บาท)</center>
                                </th>
                            </tr>
                                </thead>
                            <?php

                            $total = 0;
                            foreach ($rscartdetail as $row) {

                                $total += $row["d_subtotal"];

                                echo "<tr>";
                                echo "<td align='center'>" . @$i += 1 . "</td>";
                                echo "<td align='center'>" . "<img src='../img_product/" . $row['p_img'] . "' width='70'>" . "</td>";
                                echo "<td align='center'>" . $row["p_name"] . "</td>";
                                echo "<td  align='center'>" . '฿' . number_format($row["p_price"], 2) . "</td>";
                                echo "<td  align='center'>" . number_format($row["d_qty"], 2) . "</td>";
                                echo "<td  align='center'>" . '฿' . number_format($row["d_subtotal"], 2) . "</td>";
                                echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td colspan='5' bgcolor='#2b2929' align='center'><b>ราคารวม</b></td>";
                            echo "<td align='right' bgcolor='#2b2929'>" . "<b>" . '฿' . number_format($total, 2) . "</b>" . "</td>";
                            echo "</tr>";

                            ?>
                        </table>
                        </div>
                        <div class="col-sm-6" style="float: right; ">
                            <h3>แจ้งเลข EMS</h3>
                            <form action="ems_db.php" method="POST" class="form-horizontal">


                                <div class="col-sm-6">
                                    <input type="text" name="o_ems" class="form-control" required minlength="4" placeholder="กรอกขั้นต่ำ 4 ตัว">
                                </div>
                                <br>
                                <div class="col-sm-3">
                                    <input type="hidden" name="o_id" value="<?php echo $o_id; ?>">
                                    <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
                                </div>


                            </form>
                        </div>
                        <div class=" col-sm-6" style="float: right; ">
                        <h4> แสดงรายละเอียดการชำระเงิน </h4>
                        <h5>
                        
                                            ธนาคารที่โอนเงิน : <?php echo $rowdetail['bname']; ?><br>
                                            เลขบัญชี : <?php echo $rowdetail['bnumber']; ?><br>
                                            จำนวนเงินที่โอน : ฿<?php echo number_format($rowdetail['o_slip_total'],2); ?><br>
                                            วัน.เดือน.ปี เวลา ที่โอน : <?php echo $rowdetail['o_slip_date']; ?><br>
                                            </h5>
                                            <h4>slip</h4>
                                            <br>
                                            <a href="../img_slip/<?php echo $rowdetail['o_slip']; ?>" target="_blank"> 
                                            <img src="../img_slip/<?php echo $rowdetail['o_slip']; ?>" width="30%">
                                            </a>
                        </div>
                      

                    </div>


                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2021 © E-COMMERCE by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>KAIFARO</a></span>
                    </div>

                </footer>

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
                                    className: 'btn-outline-primary btn-sm mr-1'
                                },
                                {
                                    extend: 'copyHtml5',
                                    text: 'Copy',
                                    titleAttr: 'Copy to clipboard',
                                    className: 'btn-outline-primary btn-sm mr-1'
                                },
                                {
                                    extend: 'print',
                                    text: 'Print',
                                    titleAttr: 'Print Table',
                                    className: 'btn-outline-primary btn-sm'
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