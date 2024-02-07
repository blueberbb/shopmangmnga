<div class="modal fade" id="default-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><i class="far fa-users text-center m-md-3" style="font-size: 25px;"> +เพิ่มสมาชิก</i></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="js-login" novalidate="" method="POST" action="admin_add_member_db.inc.php" enctype="multipart/form-data">
                                        <div class="form-row">
                                       

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_username">Username</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-user-check"></i></div>
                                                <input type="text" class="form-control" id="m_username" name="m_username" placeholder="ชื่อล็อคอิน" required>
                                                <div class="invalid-feedback">กรุณากรอก Username ให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_password">รหัสผ่าน</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-key"></i></div>
                                                <input type="password" class="form-control" id="m_password" name="m_password" placeholder="รหัสผ่าน" required>
                                                <div class="invalid-feedback">กรุณากรอกรหัสผ่านให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label for="m_level">สิทธิ์การใช้งาน</label>
                                            <select name="m_level" id="m_level" class="form-control" required>
                                                <option value="">- สิทธิ์การใช้งาน -</option>
                                                <option value="MEMBER">- MEMBER</option>
                                                <option value="ADMIN">- ADMIN</option>

                                            </select>
                                        </div>

                                        <div class="col-md-6 p-1 ">
                                            <label for="m_fname">คำนำหน้าชื่อ</label>
                                            <select name="m_fname" id="m_fname" class="form-control" required>
                                                <option value="">- คำนำหน้าชื่อ -</option>
                                                <option value="นาย">- นาย</option>
                                                <option value="นาง">- นาง</option>
                                                <option value="นางสาว">- นางสาว</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_name">ชื่อ</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-user"></i></div>
                                                <input type="text" class="form-control" id="m_name" name="m_name" placeholder="ชื่อ" required>
                                                <div class="invalid-feedback">กรุณากรอกชื่อให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_lname">นามสกุล</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-user"></i></div>
                                                <input type="text" class="form-control" id="m_lname" name="m_lname" placeholder="นามสกุล" required>
                                                <div class="invalid-feedback">กรุณากรอกนามสกุลให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_phone">เบอร์โทรศัพท์</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-phone-office"></i></div>
                                                <input type="text" class="form-control" id="m_phone" name="m_phone" placeholder="เบอร์โทรศัพท์" required>
                                                <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์ให้เรียบร้อย</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_email">อีเมลล์</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-envelope-open"></i></div>
                                                <input type="email" class="form-control" id="m_email" name="m_email" placeholder="อีเมลล์" required>
                                                <div class="invalid-feedback">กรุณากรอกอีเมลล์ให้เรียบร้อย</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-1">
                                            <label class="visually-hidden" for="m_img">รูปโปรไฟล์</label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="fal fa-user-alt"></i></div>
                                                <input type="file" class="form-control" id="m_img" name="m_img" onchange="readURL(this)" accept="image/*" required>
                                                <div class="invalid-feedback">กรุณาใส่รูปโปรไฟล์ให้เรียบร้อย</div>
                                            </div>
                                            <figure class="figure d-none">
                                                <img id="imgUpload" class="figure-img img-fluid rounded text-center" alt="">

                                            </figure>
                                        </div>


                                        <div class="form-group col-md-6 p-1">
                                            <label class="visually-hidden" for="m_address">ที่อยู่</label>
                                            <div class="input-group">
                                            <div class="input-group-text"><i class="fal fa-home-lg-alt"></i></div>
                                                <textarea class="col-12 form-control" name="m_address" id="m_address" cols="30" rows="1" placeholder="ที่อยู่" required></textarea>
                                                <div class="invalid-feedback">กรุณากรอกที่อยู่ให้เรียบร้อย</div>
                                            </div>
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