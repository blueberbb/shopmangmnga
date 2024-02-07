<?php
$queryorder = "SELECT * FROM order_head WHERE o_status = 4";
$rsorder = mysqli_query($conn, $queryorder);
//echo $queryorder;

?>
<h3 class="font-weight-bold text-danger">รายการยกเลิกสินค้า</h3>
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
                <center>date</center>
            </th>
            <th width=15%>
                <center>total</center>
            </th>
           
            <th width=10%>
                <center>view</center>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rsorder as $row) { ?>
            <tr>
                <td align="center"><?php echo $row['o_id']; ?></td>
                <td>
                 
                  <?php
                   echo '<b>';
                   echo $row['o_name'];
                   echo '</b><br>';
                   echo $row['o_addr'];
                   echo '<br>';
                   echo 'เบอร์โทร.'.$row['o_phone'].' email '.$row['o_email'];
                  ?>



                </td>
                <td align="center"><?php echo $row['o_dttm']; ?></td>
                <td align="center"><?php echo number_format($row['o_total'], 2); ?></td>
                            
                <td align="center">

                    <?php
                    $o_id = $row['o_id'];
                      echo "<a href='order_detail.php?o_id=$o_id&do=order_detail' class='btn btn-warning btn-block'> เปิดดู </a>";
                    ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>