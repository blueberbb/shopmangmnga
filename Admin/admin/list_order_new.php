<?php
$queryorder = "SELECT * FROM order_head WHERE o_status = 1";
$rsorder = mysqli_query($conn, $queryorder);
//echo $queryorder;
//echo round(abs(strtotime("2021-02-20") - strtotime("2021-02-27"))/60/60/24);
if ($_GET['do'] == 'success') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "เพิ่มเลขที่จัดส่งสินค้าเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_order.inc.php">';
}
if ($_GET['do'] == 'delete') {
    echo '<script tpye="text/javascript">
    Swal.fire({icon: "success",title: "ยกเลิกการสั่งซื้อสำเร็จ",showConfirmButton: false,timer: 3000})
    </script>';
    echo '<meta http-equiv="refresh" content="2;url=admin_order.inc.php">';
}
?>
<h3 class="font-weight-bold text-warning">รายการรอชำระเงิน</h3>

    <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
        <thead class="bg-primary-600">
            <tr class="danger">
                <th width=5%>
                    <center>#</center>
                </th>
                <th width=40%>
                    <center>รายละเอียดลูกค้า</center>
                </th>
                <th width=15%>
                    <center>ว-ด-ป ที่สั่งซื้อ</center>
                </th>
                <th width=15%>
                    <center>ราคารวม</center>
                </th>

                <th width=10%>
                    <center>จำนวนวัน</center>
                </th>
                <th width=10%>
                    <center>เปิดดู</center>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rsorder as $row) {
                $o_id = $row['o_id']; ?>
                <tr>
                    <td align="center"><?php echo $row['o_id']; ?></td>
                    <td>

                        <?php
                        echo '<b>';
                        echo $row['o_name'];
                        echo '</b><br>';
                        echo $row['o_addr'];
                        echo '<br>';
                        echo 'เบอร์โทร.' . $row['o_phone'] . ' email ' . $row['o_email'];
                        ?>
                    </td>
                    <td align="center"><?php echo $row['o_dttm']; ?></td>
                    <td align="center">฿<?php echo number_format($row['o_total'], 2); ?></td>
                    <td align="center">
                        <?php
                        $o_dttm = date('Y-m-d', strtotime($row['o_dttm'])); //วันที่สั่งซื้อ
                        $datenow = date('Y-m-d');

                        //    echo 'วันที่สั่งซื้อ'.$o_dttm;
                        //    echo '<br>';
                        //    echo 'วันปัจจุบัน'.$datenow;


                        $caldate = round(abs(strtotime("$o_dttm") - strtotime("$datenow")) / 60 / 60 / 24);


                        echo $caldate . 'วัน';
                        echo '<br>';
                        if ($caldate > 3) {
                            echo "<a href='order_detail.php?o_id=$o_id&do=order_cancel' class='btn btn-danger btn-block'>ยกเลิก</a>";
                        } else {
                            echo '-';
                        }

                        ?>
                    </td>

                    <td align="center">

                        <?php

                        echo "<a href='order_detail.php?o_id=$o_id&do=order_detail' class='btn btn-warning btn-block' target='_blank'> เปิดดู </a>";
                        ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
