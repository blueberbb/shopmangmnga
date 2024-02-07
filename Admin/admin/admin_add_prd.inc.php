<?php
session_status();
$m_id = $_SESSION['m_id'];
include_once('../connect/conndb.php');


$query = "SELECT * FROM tbl_prd_type " or die("Error:" . mysqli_error($conn));
$result = mysqli_query($conn, $query);
?>
<div class="modal fade" id="default-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title text-center"><i class="fal fa-cart-plus text-center m-md-3" style="font-size: 25px;"> +เพิ่มสินค้า</i></h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="js-login" novalidate="" method="POST" action="admin_add_prd_db.inc.php" enctype="multipart/form-data">
                    <div class="form-row">

                        <div class="col-md-3 p-1">
                            <label class="visually-hidden" for="p_img">รูปสินค้า</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                <input type="file" class="form-control" id="p_img" name="p_img" onchange="readURL(this)" accept="image/*" required>
                                <div class="invalid-feedback">กรุณาเพิ่มรูปสินค้า</div>
                            </div>
                            <figure class="figure d-none">
                                <img id="imgUpload" class="figure-img img-fluid rounded text-center" alt="">

                            </figure>
                        </div>

                        <div class="col-md-3 p-1">
                            <label class="visually-hidden" for="p_img1">รูปสินค้า2</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                <input type="file" class="form-control" id="p_img1" name="p_img1" onchange="readURL2(this)" accept="image/*" required>
                                <div class="invalid-feedback">กรุณาเพิ่มรูปสินค้า2</div>
                            </div>
                            <figure class="figure d-none">
                                <img id="imgUpload2" class="figure-img img-fluid rounded text-center" alt="">

                            </figure>
                        </div>

                        <div class="col-md-3 p-1">
                            <label class="visually-hidden" for="p_img2">รูปสินค้า3</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                <input type="file" class="form-control" id="p_img2" name="p_img2" onchange="readURL3(this)" accept="image/*" required>
                                <div class="invalid-feedback">กรุณาเพิ่มรูปสินค้า3</div>
                            </div>
                            <figure class="figure d-none">
                                <img id="imgUpload3" class="figure-img img-fluid rounded text-center" alt="">

                            </figure>
                        </div>

                        <div class="col-md-3 p-1">
                            <label class="visually-hidden" for="p_img3">รูปสินค้า4</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                <input type="file" class="form-control" id="p_img3" name="p_img3" onchange="readURL4(this)" accept="image/*" required>
                                <div class="invalid-feedback">กรุณาเพิ่มรูปสินค้า4</div>
                            </div>
                            <figure class="figure d-none">
                                <img id="imgUpload4" class="figure-img img-fluid rounded text-center" alt="">

                            </figure>
                        </div>
                        <div class="col-md-6 p-1">
                            <label class="visually-hidden" for="p_name">ชื่อสินค้า</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-cart-plus"></i></div>
                                <input type="text" class="form-control" id="p_name" name="p_name" placeholder="ชื่อสินค้า" required>
                                <div class="invalid-feedback">กรุณากรอกชื่อสินค้า</div>
                            </div>
                        </div>


                        <div class="col-md-6 p-1">
                            <label for="ref_t_id">ประเภทสินค้า</label>

                            <select name="ref_t_id" id="ref_t_id" class="form-control" required>
                                <option value="">-ประเภทสินค้า-</option>
                                <?php foreach ($result as $results) { ?>
                                    <option value="<?php echo $results["t_id"]; ?>">
                                        - <?php echo $results["t_name"]; ?></option>
                                <?php } ?>

                            </select>
                        </div>


                        <div class="col-md-6 p-1">
                            <label class="visually-hidden" for="p_price">ราคา</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-money-bill-wave"></i></div>
                                <input type="number" class="form-control" id="p_price" name="p_price" placeholder="ราคา" required>
                                <div class="invalid-feedback">กรุณากรอกราคา</div>
                            </div>
                        </div>

                        <div class="col-md-6 p-1">
                            <label class="visually-hidden" for="p_qty">จำนวนสินค้า</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-calendar-check"></i></div>
                                <input type="number" class="form-control" id="p_qty" name="p_qty" placeholder="จำนวนสินค้า" required>
                                <div class="invalid-feedback">กรุณากรอกจำนวน</div>
                            </div>
                        </div>

                      
                        <div class="col-md-12 p-1">
                            <label class="visually-hidden" for="p_intro">รายละเอียดสินค้าแบบสั้นๆ</label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="fal fa-list"></i></div>
                                <input type="text" class="form-control" id="p_intro" name="p_intro" placeholder="รายละเอียดสินค้าแบบสั้นๆ" required>
                                <div class="invalid-feedback">กรุณากรอกรายละเอียดสินค้าแบบสั้นๆ</div>
                            </div>
                        </div>

                        <div class="form-group col-12 p-1">
                            <label class="visually-hidden" for="p_detail">รายละเอียดสินค้า</label>
                            <div class="input-group">
                                <textarea class="col-12 form-control" name="p_detail" cols="10" rows="5" placeholder="รายละเอียดสินค้า"  required></textarea>

                            </div>
                            <div class="invalid-feedback">กรุณากรอกรายละเอียดสินค้า</div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="ref_m_id" value="<?php echo $m_id; ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" id="js-add-btn" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>