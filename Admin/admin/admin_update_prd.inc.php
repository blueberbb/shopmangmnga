<?php
include_once('admin_head.inc.php');
$query = "SELECT l.*, m.m_username
 FROM tbl_prd_update_log as l 
 INNER JOIN tbl_member as m ON l.ref_m_id=m.m_id
 WHERE l.ref_p_id=$ID
 ORDER BY l.lid DESC"
or die("Error:" . mysqli_error($conn));
// echo $sql;
// exit;
// $result = $conn->query($sql);
$result = mysqli_query($conn, $query);

?>

<table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
    <thead class="bg-primary-600">
        <tr>
            <th class="text-center" width='10%'>#</th>
            <th class="text-center" width='60%'>ผู้แก้ไขสินค้า</th>
            <th class="text-center" width='30%'>วันที่แก้ไขสินค้า</th>
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
                <td class="text-center"><?php echo $row['m_username']; ?></td>
                <td class="text-center"><?php echo date('d-m-Y H:i:s',strtotime($row['l_date_save'])); ?></td>
               
            </tr>
        <?php
            $i++;
        }
        ?>
    </tbody>

</table>