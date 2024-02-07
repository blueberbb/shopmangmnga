<?php
session_start();
include_once('../connect/conndb.php');
include('member_head.inc.php');

$o_id = mysqli_real_escape_string($conn, $_GET['o_id']);
$querycartdetail =
    "SELECT d.*,p.p_img, p.p_name, p.p_price, h.*
FROM order_detail as d
INNER JOIN order_head as h ON d.o_id = h.o_id
INNER JOIN tbl_prd as p ON d.p_id = p.p_id
WHERE d.o_id=$o_id
AND h.m_id=$m_id";

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
        payment
    </title>

    <?php include('member_linkon.inc.php'); ?>

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

                <?php include('member_menu_l.inc.php'); ?>

            </aside>
            <!-- END Left Aside -->
            <div class="page-content-wrapper">
                <!-- BEGIN Page Header -->
                <?php include('member_menu_r.inc.php'); ?>

                <main id="js-page-content" role="main" class="page-content">
                    <i class="fal fa-money-bill-alt text-center m-md-6 " style="font-size: 30px;"> <b style="font-family: 'Prompt', sans-serif;">แจ้งชำระเงิน</b></i>

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
                                <th width="5%" >
                                    <center>#</center>
                                </th>
                                <th width="5%" >
                                    <center>img</center>
                                </th>
                                <th width="50%" >
                                    <center>สินค้า</center>
                                </th>
                                <th width="10%" >
                                    <center>ราคา</center>
                                </th>
                                <th width="10%" >
                                    <center>จำนวน</center>
                                </th>
                                <th width="10%" >
                                    <center>รวม(บาท)</center>
                                </th>
                            </tr>
                        </thead>
                            <?php


                            foreach ($rscartdetail as $row) {
                                $total += $row["d_subtotal"];
                                echo "<tr>";
                                echo "<td align='center'>" . @$i += 1 . "</td>";
                                echo "<td align='center' >" . "<img src='../img_product/" . $row['p_img'] . "' width='70px'>" . "</td>";
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
                    <h4><i class="fal fa-landmark"> เลือกธนาคารที่ชำระ/โอนเงิน</i></h4>
                    <form action="payment_db.php" method="POST" class="form-horizontal" enctype="multipart/form-data">

                        <?php
                        echo '
                        
                        <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
                        <thead class="bg-primary-600">
                                <tr>
                                    <th width="5%" >
                                        <center>เลือก</center>
                                    </th>
                                    <th width="5%" >
                                    <center>รูปธนาคาร</center>
                                </th>
                                                                                
                                    <th width="15%" >
                                        <center>ธนาคาร</center>
                                    </th>
                                    
                                    <th width="25%" >
                                        <center>เลขบัญชี</center>
                                    </th>
                                    <th width="25%" >
                                        <center>ชื่อเจ้าของบัญชี</center>
                                    </th>
                                </tr>
                                </thead>';
                        foreach ($rsbank as $rsb) {
                            $bid = $rsb["bid"];
                            echo '<tr>';
                            echo "<td align='center'>" . "<input type='radio' name='bid' required  value='$bid'>" . "</td>";
                            echo "<td align='center'>" . "<img src='../img_bank/" . $rsb['b_img'] . "' width='70px'>" . "</td>";
                            echo "<td align='center'>" . $rsb["bname"] . "</td>";
                            echo "<td align='center'>" . $rsb["bnumber"] . "</td>";
                            echo "<td align='center'>" . $rsb["bowner"] . "</td>";
                            echo '</tr>';
                        }

                        echo '</table>';

                        ?>

                        <div class="form-group">
                            <div class="form-row">
                            <div class="col-md-4">
                                วันที่ชำระเงิน <br>
                                <input type="datetime-local" name="o_slip_date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                จำนวนเงินที่โอน <br>
                                <input type="number" class="form-control" name="o_slip_total" any required min="0" value="<?php echo $total; ?>">
                            </div>
                        <!-- </div> -->
                        <!-- <div class="form-group"> -->
                            <div class="col-md-4">
                                อัพโหลดสลิป<br>
                                <!-- <input type="file" name="o_slip" class="form-control" required accept="image/*"> -->
                                <input type="file" class="form-control" name="o_slip" id="m_img"   onchange="readURL(this)" accept="image/*">
                                <figure class="figure d-none">
                                    <img id="imgUpload" class="figure-img img-fluid  text-center">
                                </figure>
                            </div>
                            <div class="col-md-4">
                                <br>
                                <input type="hidden" name="o_id" value="<?php echo $o_id; ?>">
                                <button type="submit" class="btn btn-primary ">แจ้งชำระเงิน</button>
                            </div>
                        </div>
                        </div>
                    </form>

                </main>
                <!-- this overlay is activated only when mobile menu is triggered -->
                <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                <!-- BEGIN Page Footer -->
                <footer class="page-footer" role="contentinfo">
                    <div class="d-flex align-items-center flex-1 text-muted">
                        <span class="hidden-md-down fw-700">2022 © E-COMMERCE by&nbsp;<a href='#' class='text-primary fw-500' title='#' target='_blank'>KAIFARO</a></span>
                    </div>
                </footer>
                <?php include('member_setting.inc.php'); ?>

                <script src="js/vendors.bundle.js"></script>
                <script src="js/app.bundle.js"></script>
                <script>
                    function readURL(input) {
                        if (input.files[0]) {
                            var reader = new FileReader()
                            $('.figure').addClass('d-block')
                            reader.onload = function(e) {
                                $('#imgUpload').attr('src', e.target.result).height(400)
                            }
                            reader.readAsDataURL(input.files[0])
                        }
                    }

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