<?php
include('admin_head.inc.php');


$sql = "SELECT
DATE_FORMAT(log_date, '%M-%Y') AS mydate ,
COUNT(ref_m_id) AS total
FROM tbl_login_log 
GROUP BY DATE_FORMAT(log_date, '%m%')
" or die("Error:" . mysqli_error($conn));
$result = $conn->query($sql);


?>

                    <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
                        <thead class="bg-primary-600">
                            <tr>
                                <th class="text-center" width='5%'>#</th>

                                <th class="text-center" width='70%'>เดือน</th>

                                <th class="text-center" width='25%'>รวม (ครั้ง)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            while ($row = $result->fetch_assoc()) {

                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class="text-center"><?php echo $row['mydate']; ?></td>
                                    <td class="text-center"><?php echo $row['total']; ?></td>
                                    
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>

                    </table>


            