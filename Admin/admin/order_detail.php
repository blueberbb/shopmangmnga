<?php
session_start();
include_once('../connect/conndb.php');
include('admin_head.inc.php');

$o_id = mysqli_real_escape_string($conn, $_GET['o_id']);
$querycartdetail =
"SELECT d.*,p.p_img, p.p_name, p.p_price, h.*
FROM order_detail as d
INNER JOIN order_head as h ON d.o_id = h.o_id
INNER JOIN tbl_prd as p ON d.p_id = p.p_id
WHERE d.o_id=$o_id
";
$rscartdetail = mysqli_query($conn, $querycartdetail);
$rowdetail = mysqli_fetch_array($rscartdetail); //css 

?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        order_detail
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
                    <i class=" text-center m-md-6 " style="font-size: 30px;"> <b style="font-family: 'Prompt', sans-serif;">รายละเอียดการสั่งซื้อสินค้า</b></i>

                    <h4>
                        <b class="text-info">OrderId :</b> <?php echo $rowdetail['o_id']; ?><br>
                        <b class="text-info">ส่งไปที่ :</b> <?php echo $rowdetail['o_name']; ?> <br>
                        <?php echo $rowdetail['o_addr']; ?><br>
                        <b class="text-info">เบอร์โทร :</b> <?php echo $rowdetail['o_phone']; ?>,
                        <b class="text-info">Email :</b> <?php echo $rowdetail['o_email']; ?><br>
                        <b class="text-info">วันที่สั่งซื้อ :</b> <?php echo $rowdetail['o_dttm']; ?><br>
                        <b class="text-info"> สถานะ :</b> <?php
                                                            $st = $rowdetail['o_status'];
                                                            echo '<font color="#00FF00">';
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
                                        <center>รูปสินค้า</center>
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
                                    <th width="10%">
                                        <center>รวม(บาท)</center>
                                    </th>
                                </tr>
                            </thead>
                            <?php


                            foreach ($rscartdetail as $row) {
                                $total += $row["d_subtotal"];
                                echo "<tr>";
                                echo "<td align='center'>" . @$i += 1 . "</td>";
                                echo "<td align='center' >" . "<img src='../img_product/" . $row['p_img'] . "' width='100'>" . "</td>";
                                echo "<td align='center'>" . $row["p_name"] . "</td>";
                                echo "<td  align='center'>" . '฿' . number_format($row["p_price"], 2) . "</td>";
                                echo "<td  align='center'>" . number_format($row["d_qty"], 2) . "</td>";
                                echo "<td  align='center'>" . '฿' . number_format($row["d_subtotal"], 2) . "</td>";
                                echo "</tr>";
                            }
                            echo "<tr>";
                            echo "<td colspan='5' bgcolor='#1c1a1a' align='center'><b>ราคารวม :</b></td>";
                            echo "<td align='right' bgcolor='#1c1a1a'>" . "<center>" . "<b>" . '฿' . number_format($total, 2) . "</b>" . "</center>" . "</td>";
                            echo "</tr>";

                            ?>
                        </table>
                        </div>
                        <?php if($_GET['do']=='order_cancel'){?>
                        <!-- <form action="order_cancel.php" method="post"> -->
                            <!-- <input type="hidden" name="o_id" value="<?php echo $o_id;?>"> -->
                        <!-- <button type="submit" class="btn btn-danger " onclick="return confirm('ยืนยันการยกเลิก')">ยืนยันการยกเลิก Order</button>  -->
                        <!-- </form> -->
                        <div >
                        <a href="order_cancel.php?o_id=<?php echo $row['o_id']; ?>" class="btn btn-danger btn-del">
                        ยกเลิก Order
                     </a>
                     </div>
                    <?php }?>

                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2022 © E-COMMERCE by&nbsp;<a href='https://www.gotbootstrap.com' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>KAIFARO</a></span>
                    </div>
                </footer>
                <?php include('member_setting.inc.php'); ?>
                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script src="js/datagrid/datatables/datatables.bundle.js"></script>
                <script src="js/datagrid/datatables/datatables.export.js"></script>
                <script>
                        $('.btn-del').click(function(e) {
                        // var userId = $(this).data('t_id');
                        e.preventDefault();
                        const href = $(this).attr('href')

                        Swal.fire({
                            title: 'คุณต้องการลบ Order สินค้านี้หรือไม่?',
                            text: 'ถ้าลบแล้วจะไม่สามารถกู้คืนได้ !',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'ใช่, ลบเลย !',
                            cancelButtonText: 'ยกเลิก',
                        }).then((result) => {
                                if (result.value){
                                    document.location.href = href;
                                }
                        })

                    })
                </script>
</body>
<!-- END Body -->

</html>