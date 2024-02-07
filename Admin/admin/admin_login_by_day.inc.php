
<?php
// include('admin_head.inc.php');
$ds = $_GET['ds'];
$de = $_GET['de'];

if($ds==''){

}else{

$sql = "SELECT l.ref_m_id,m.m_username, l.log_date
FROM tbl_login_log as l
INNER JOIN tbl_member as m ON l.ref_m_id=m.m_id
WHERE l.log_date
BETWEEN '$ds 00:00:00.000000'
AND '$de 00:00:00.000000'
ORDER BY l.log_id ASC
" or die("Error:" . mysqli_error($conn));
$result = $conn->query($sql);

?>


                   
                    <table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
                        <thead class="bg-primary-600">
                            <tr>
                                <th class="text-center" width='5%'>#</th>
                                <th class="text-center" width='70%'>ชื่อผู้ใช้งาน</th>
                                <th class="text-center" width='25%'>วัน-เดือน-ปี ที่เข้าใช้ระบบ</th>
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
                                    <td class="text-center"><?php echo $row['log_date']; ?></td>

                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
                        </tbody>

                    </table>
                    <?php
                                
                            }
                            ?>