<div class="modal fade" id="default-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="fal fa-landmark text-center m-md-3" style="font-size: 25px;"> + บัญชีธนาคาร</i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="js-login" novalidate="" method="POST" action="admin_add_bank_db.inc.php" enctype="multipart/form-data">
                                        <div class="form-row">
                                                         

                                       
                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="bname">ชื่อธนาคาร</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-landmark"></i></div>
                                                <input type="text" class="form-control" id="bname" name="bname" placeholder="ชื่อธนาคาร" required>
                                                <div class="invalid-feedback">กรุณากรอกชื่อชื่อธนาคาร</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="bnumber">เลขบัญชีธนาคาร</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-landmark"></i></div>
                                                <input type="text" class="form-control" id="bnumber" name="bnumber" placeholder="เลขบัญชีธนาคาร" required>
                                                <div class="invalid-feedback">กรุณากรอกเลขบัญชีธนาคารให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="bowner">ชื่อเจ้าของบัญชีธนาคาร</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-address-card"></i></div>
                                                <input type="text" class="form-control" id="bowner" name="bowner" placeholder="ชื่อเจ้าของบัญชีธนาคาร" required>
                                                <div class="invalid-feedback">กรุณากรอกชื่อเจ้าของบัญชีธนาคารให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                       
                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_img">รูปธนาคาร</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-landmark"></i></div>
                                                <input type="file" class="form-control" id="b_img" name="b_img" onchange="readURL(this)" accept="image/*" required>
                                                <div class="invalid-feedback">กรุณาใส่รูปรูปธนาคารให้เรียบร้อย</div>
                                            </div>
                                            <figure class="figure d-none">
                                                <img id="imgUpload" class="figure-img img-fluid rounded text-center" alt="">

                                            </figure>
                                        </div>
                               
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                                            <button type="submit" id="js-add-btn" name="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>