<?php
include_once('admin_head.inc.php');
$query = "SELECT p.*,m.m_username, t.t_name
FROM tbl_prd as p
LEFT JOIN tbl_member as m ON p.ref_m_id=m.m_id
LEFT JOIN tbl_prd_type as t ON p.ref_t_id=t.t_id 
ORDER BY p.p_id DESC"
or die("Error:" . mysqli_error($conn));
// echo $sql;
// exit;
// $result = $conn->query($sql);
$result = mysqli_query($conn, $query);
if ($_GET['do'] == 'success') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "บันทึกสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_prd.inc.php">';
}

if ($_GET['do'] == 'check') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "มีสินค้าซ้ำกรุณากรอกใหม่อีกครั้ง!!!",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_prd.inc.php">';
}

if ($_GET['do'] == 'edit') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "แก้ไขสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_prd.inc.php">';
}

if ($_GET['do'] == 'fail') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "error",title: "แก้ไขสินค้าไม่สำเร็จ",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_prd.inc.php">';
}

if ($_GET['do'] == 'delete') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "ลบสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_prd.inc.php">';
}

?>

<table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
    <thead class="bg-primary-600">
        <tr>
            <th class="text-center" width='3%'>#</th>
            <th class="text-center" width='8%'>รูปสินค้า</th>
            <th class="text-center" width='10%'>ชื่อสินค้า</th>
            <th class="text-center" width='10%'>ประเภทสินค้า</th>
            <th class="text-center" width='25%'>รายละเอียดสินค้าแบบสั้นๆ</th>
            <th class="text-center" width='5%'>View</th>
            <th class="text-center" width='5%'>ราคา</th>
            <th class="text-center" width='5%'>จำนวน</th>
            <th class="text-center" width='8%'>ผู้เพิ่มสินค้า</th>
            <th class="text-center" width='8%'>วันเพิ่มสินค้า</th>
            <!-- <th class="text-center" width='8%'>วันอัพเดทสินค้า</th> -->
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        // while ($row = $result->fetch_assoc()) {
            while($row = mysqli_fetch_array($result)){

        ?>
            <tr>
                <td class="text-center"><?php echo $i; ?></td>
                <td class="text-center"><img src="../img_product/<?= $row['p_img']; ?>" width='60%'></td>
                <td class="text-center"><?php echo $row['p_name']; ?></td>
                <td class="text-center"><?php echo $row['t_name']; ?></td>
                <td class="text-center"><?php echo $row['p_intro']; ?></td>
                <td class="text-center"><?php echo $row['p_view']; ?></td>
                <td class="text-center"><?php echo number_format($row['p_price'],2); ?></td>
                <td class="text-center"><?php echo number_format($row['p_qty'],2); ?></td>
                <td class="text-center"><?php echo $row['m_username'];?></td>
                <td class="text-center"><?php echo date('d-m-Y',strtotime($row['p_datesave'])); ?></td>
                <td class="text-center">

                    <a href="admin_edit_prd.inc.php?p_id=<?php echo $row['p_id']; ?>">
                        <i class="fal fa-comment-alt-edit cursor-pointer mr-3 " style="font-size: 16px;color: #F9A703;"></i>
                    </a>

                    <a href="admin_delete_prd_db.inc.php?p_id=<?php echo $row['p_id']; ?>" class="btn-del">
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