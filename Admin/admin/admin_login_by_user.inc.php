<?php
include('admin_head.inc.php');
$sql = "SELECT l.ref_m_id, m.m_username, COUNT(l.ref_m_id) as total
FROM tbl_login_log as l
INNER JOIN tbl_member as m ON l.ref_m_id=m.m_id
GROUP BY l.ref_m_id
" or die("Error:" . mysqli_error($conn));
$result = $conn->query($sql);
?>

                                  

                    <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
                        <thead class="bg-primary-600">
                            <tr>
                                <th class="text-center" width='5%'>#</th>

                                <th class="text-center" width='70%'>ชื่อผู้เข้าระบบ</th>

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

                                    <td class="text-center"><?php echo $row['m_username']; ?></td>
                                    <td class="text-center"><?php echo $row['total']; ?></td>
                                    
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>

                    </table>



              