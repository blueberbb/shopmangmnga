<?php
$queryorder = "SELECT * FROM order_head WHERE m_id=$m_id ";
$rsorder = mysqli_query($conn, $queryorder);
//echo $queryorder;

?>

</script>
<!-- <div style='overflow-x:auto; font-size: 15px;'> -->
<i class="fal fa-money-check-edit-alt text-center m-md-6 text-info" style="font-size: 30px;">ประวัติการสั่งซื้อสินค้า</i>
<table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
    <thead class="bg-primary-600">
        <tr class="danger">
            <th width=3%>
                <center>#</center>
            </th>
            <th width=10%>
                <center>status</center>
            </th>
            <th width=15%>
                <center>date</center>
            </th>
            <th width=10%>
                <center>total</center>
            </th>
            <th width=10%>
                <center>slip</center>
            </th>
            <th width=10%>
                <center>ems</center>
            </th>
            <th width=5%>
                <center>view</center>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rsorder as $row) { ?>
            <tr>
                <td align="center"><?php echo $row['o_id']; ?></td>
                <td align="center">
                    <?php
                    $st = $row['o_status'];
                    if ($st == 1) {
                        echo "<font color='#ffc800'>";
                        echo 'รอชำระเงิน';
                        echo "</font>";
                    } elseif ($st == 2) {
                        echo "<font color='#00eaff'>";
                        echo 'ชำระเงินแล้ว';
                        echo "</font>";
                    } elseif ($st == 3) {
                        echo "<font color='#00FF00'>";
                        echo 'ตรวจสอบเลข EMS';
                        echo "</font>";
                    } else {
                        echo "<font color='#ff2600'>";
                        echo 'ยกเลิก';
                        echo "</font>";
                    }
                    ?>

                </td>
                <td align="center"><?php echo $row['o_dttm']; ?></td>
                <td align="center"><?php echo number_format($row['o_total'], 2); ?></td>
                <td align="center">slip</td>
                <td align="center"><?php echo $row['o_ems']; ?></td>
                <td align="center">

                    <?php
                    $o_id = $row['o_id'];
                    if ($st == 1) {
                        echo "<a href='payment.php?o_id=$o_id&do=payment' class='btn btn-warning btn-block'> ชำระเงิน </a>";
                    } elseif ($st == 2) {
                        echo "<a href='member_payment_detail.inc.php?o_id=$o_id&do=payment_detail' class='btn btn-info btn-block'> เปิดดู </a>";
                    } elseif ($st == 3) {
                        echo "<a href='payment_detail.php?o_id=$o_id&do=payment_detail' class='btn btn-success btn-block'> ดูเลข EMS  </a>";
                    } else {
                        echo "<a href='member_order_detail.inc.php?o_id=$o_id&do=order_detail' class='btn btn-danger btn-block'> ยกเลิก </a>";
                    }
                    ?>


                </td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<!-- </div> -->