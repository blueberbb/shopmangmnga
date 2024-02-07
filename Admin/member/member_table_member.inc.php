 <?php
include_once('../connect/conndb.php');
$sql = "SELECT * FROM tbl_member";
$result = $conn->query($sql);
if ($_GET['do'] == 'success') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "บันทึกข้อมูลเรียบร้อยแล้ว",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="3;url=admin_member.inc.php">';
}

if ($_GET['do'] == 'check') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "มี User ซ้ำกรุณากรอกใหม่อีกครั้ง!!!",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="3;url=admin_member.inc.php">';
}

if ($_GET['do'] == 'edit') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "แก้ไขข้อมูลเรียบร้อยแล้ว",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="3;url=admin_member.inc.php">';
}

if ($_GET['do'] == 'fail') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "แก้ไขข้อมูลไม่สำเร็จ",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="3;url=admin_member.inc.php">';
}

if ($_GET['do'] == 'delete') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "ลบข้อมูลเรียบร้อยแล้ว",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="3;url=admin_member.inc.php">';
}

 ?>






<table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
     <thead class="bg-primary-600">
         <tr>
             <th class="text-center" width='3%'>#</th>
             <th width='10%'>รูป</th>
             <th class="text-center" width='8%'>User</th>
             <th class="text-center" width='13%'>ชื่อ-นามสกุล</th>
             <th class="text-center" width='15%'>อีเมลล์</th>
             <th class="text-center" width='8%'>เบอร์โทร</th>
             <th class="text-center" width='27%'>ที่อยู่</th>
             <th class="text-center" width='8%'>ว-ด-ป</th>
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
                 <td class="text-center"><img src="../profile/<?= $row['m_img']; ?>" width='60%' ></td>
                 <td class="text-center"><?php echo $row['m_username']; ?></td>
                 <td class="text-center"><?php echo $row['m_fname'] . $row['m_name'] . ' ' . $row["m_lname"]; 
                 echo '<br/>';
                 echo 'ระดับผู้ใช้งาน = '.$row["m_level"];?>
                </td>
                 <td class="text-center"><?php echo $row['m_email']; ?></td>
                 <td class="text-center"><?php echo $row['m_phone']; ?></td>
                 <td class="text-center"><?php echo $row['m_address']; ?></td>
                 <td class="text-center"><?php echo date('d-m-Y',strtotime($row['m_datesave'])); ?></td>
                 <td class="text-center">
                    
                     <a href="admin_edit_member.inc.php?m_id=<?php echo $row['m_id']; ?>">
                         <i class="far fa-user-edit cursor-pointer mr-2 " style="font-size: 16px;color: #F9A703;" ></i>
                     </a>

                     <a href="admin_delete_member_db.inc.php?m_id=<?php echo $row['m_id']; ?>" onclick="return confirm('คุณต้องการลบ User นี้หรือไม่!!!');">
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