<?php
include_once('../connect/conndb.php');
$sql = "SELECT * FROM tbl_prd_type";
$result = $conn->query($sql);
if ($_GET['do'] == 'success') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "บันทึกประเภทสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_type.inc.php">';
}

if ($_GET['do'] == 'check') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "มีประเภทสินค้าซ้ำกรุณากรอกใหม่อีกครั้ง!!!",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_edit_type.inc.php">';
}

if ($_GET['do'] == 'edit') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "แก้ไขประเภทสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_type.inc.php">';
}

if ($_GET['do'] == 'fail') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "แก้ไขประเภทสินค้าไม่สำเร็จ",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_type.inc.php">';
}

if ($_GET['do'] == 'delete') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "ลบประเภทสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 4000})
    </script>';
    echo '<meta http-equiv="refresh" content="3;url=admin_type.inc.php">';
}

 ?>






 <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
     <thead class="bg-primary-600">
         <tr>
             <th class="text-center" width='15%'>#</th>
            
             <th class="text-center" width='60%'>ประเภทสินค้า</th>
             
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
                 
                 <td class="text-center"><?php echo $row['t_name']; ?></td>
                
                 <td class="text-center">
                    
                     <a href="admin_edit_type.inc.php?t_id=<?php echo $row['t_id']; ?>">
                         <i class="fal fa-comment-alt-edit cursor-pointer mr-3 " style="font-size: 16px;color:#F9A703;" ></i>
                     </a>

                     <a href="admin_delete_type_db.inc.php?t_id=<?php echo $row['t_id']; ?>" onclick="return confirm('คุณต้องการลบประเภทสินค้านี้หรือไม่!!!');">
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