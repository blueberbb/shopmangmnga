<?php
include_once('../connect/conndb.php');
$sql = "SELECT * FROM tbl_bank ";
$result = $conn->query($sql);

if ($_GET['do'] == 'success') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "บันทึกข้อมูลธนาคารเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_bank.inc.php">';
}

if ($_GET['do'] == 'check') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "มี ธนาคาร ซ้ำกรุณากรอกใหม่อีกครั้ง!!!",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_bank.inc.php">';
}

if ($_GET['do'] == 'edit') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "แก้ไขข้อมูลธนาคารเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_bank.inc.php">';
}

if ($_GET['do'] == 'fail') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "แก้ไขข้อมูลธนาคารไม่สำเร็จ",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_bank.inc.php">';
}

if ($_GET['do'] == 'delete') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "ลบข้อมูลธนาคารเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_bank.inc.php">';
}

 ?>

 <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
     <thead class="bg-primary-600">
         <tr>
             <th class="text-center" width='3%'>#</th>
             <th width='10%'>รูป</th>
             <th class="text-center" width='25%'>ชื่อธนาคาร</th>
             <th class="text-center" width='20%'>เลขบัญชี</th>
             <th class="text-center" width='30%'>ชื่อเจ้าของบัญชี</th>
                        
             <th></th>
         </tr>
     </thead>
     <tbody>
         <?php
            $i = 1;
            while ($row = $result->fetch_assoc()) {

            ?>
             <tr>
                 <td class="text-center"><?php echo $i; ?></td>
                 <td class="text-center"><img src="../img_bank/<?= $row['b_img']; ?>" width='60%' ></td>
                 <td class="text-center"><?php echo $row['bname']; ?></td>
                 <td class="text-center"><?php echo $row['bnumber']; ?></td>
                 <td class="text-center"><?php echo $row['bowner']; ?></td>
                 <td class="text-center">
                    
                     <a href="admin_edit_bank.inc.php?bid=<?php echo $row['bid']; ?>" >
                         <i class="fal fa-comment-alt-edit cursor-pointer mr-2 " style="font-size: 16px;color: #F9A703;" ></i>
                     </a>

                     <a href="admin_delete_bank_db.inc.php?bid=<?php echo $row['bid']; ?>" class="btn-del">
                         <i class="far fa-trash-alt cursor-pointer" style="font-size: 16px;color: #F55B5B ;"></i>
                     </a>

                 </td>
             </tr>
         <?php
                $i++;
            }
            ?>
     </tbody>

 </table>