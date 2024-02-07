<?php

include('admin_head.inc.php');
include_once('../connect/conndb.php');

if (!isset($_GET['bid'])) {
    header('Location:admin_bank.inc.php');
}
$sql = "SELECT * FROM tbl_bank WHERE bid = '" . $_GET['bid'] . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        Admin_bank
    </title>
    <?php include('admin_linkon.inc.php'); ?>
</head>


<body class="mod-bg-1 mod-nav-link ">


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
                <?php include('admin_menu_r.inc.php'); ?>

                <main id="js-page-content" role="main" class="page-content">
                    <i class="fal fa-landmark text-center m-md-3" style="font-size: 25px;"> บัญชีธนาคาร</i>

                    <div class="" id="" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fal fa-landmark text-center m-md-3" style="font-size: 25px;"> + แก้ไขบัญชีธนาคาร</i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form id="js-login" novalidate="" method="POST" action="admin_edit_bank_db.inc.php" enctype="multipart/form-data">
                                    <img src="../img_bank/<?php echo $row['b_img']; ?>" width="150px" height="150px">
                                    <br>
                                        <label class="visually-hidden" for="b_img">รูปธนาคารเก่า</label> 
                                        <div class="form-row">
                                  
                                                                                  

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="bname">ชื่อธนาคาร</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-landmark"></i></div>
                                                    <input type="text" class="form-control" id="bname" name="bname" value="<?php echo $row['bname']; ?>" required>
                                                    <div class="invalid-feedback">กรุณากรอกชื่อชื่อธนาคาร</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="bnumber">เลขบัญชีธนาคาร</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-landmark"></i></div>
                                                    <input type="text" class="form-control" id="bnumber" name="bnumber" value="<?php echo $row['bnumber']; ?>" required>
                                                    <div class="invalid-feedback">กรุณากรอกเลขบัญชีธนาคารให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="bowner">ชื่อเจ้าของบัญชีธนาคาร</label>
                                                <div class="input-group">
                                                    <div class="input-group-text"><i class="fal fa-address-card"></i></div>
                                                    <input type="text" class="form-control" id="bowner" name="bowner" value="<?php echo $row['bowner']; ?>" required>
                                                    <div class="invalid-feedback">กรุณากรอกชื่อเจ้าของบัญชีธนาคารให้เรียบร้อย</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 p-1">
                                                <label class="visually-hidden" for="m_img">รูปธนาคาร</label>
                                                <div class="input-group">
                                                   
                                                    <div class="input-group-text"><i class="fal fa-landmark"></i></div>
                                                    <input type="file" class="form-control" id="b_img" name="b_img" onchange="readURL(this)" accept="image/*" >
                                                    <div class="invalid-feedback">กรุณาใส่รูปรูปธนาคารให้เรียบร้อย</div>
                                                </div>
                                                <figure class="figure d-none">
                                                    <img id="imgUpload" class="figure-img img-fluid rounded text-center" alt="">

                                                </figure>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                        <input type="hidden" name="b_img2" value="<?php echo $row['b_img']; ?>">
                                            <input type="hidden" name="bid" value="<?php echo $row['bid']; ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            <button type="submit" id="js-add-btn" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
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


                    function readURL(input) {
                        if (input.files[0]) {
                            var reader = new FileReader()
                            $('.figure').addClass('d-block')
                            reader.onload = function(e) {
                                $('#imgUpload').attr('src', e.target.result).height(200)
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

                    $('.btn-del').click(function(e) {
                        // var userId = $(this).data('t_id');
                        e.preventDefault();
                        const href = $(this).attr('href')

                        Swal.fire({
                            title: 'คุณต้องการลบ User นี้หรือไม่?',
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