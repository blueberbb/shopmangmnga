<meta charset="utf-8">
<?php

include_once('../connect/conndb.php');

$o_ems = mysqli_real_escape_string($conn, $_POST["o_ems"]);
$o_id = mysqli_real_escape_string($conn, $_POST["o_id"]);
$o_ems_date = date('Y-m-d H:i:h');

$sql = "UPDATE order_head SET 
o_ems='$o_ems',
o_ems_date='$o_ems_date',
o_status=3
WHERE o_id=$o_id 
";

$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

// echo $sql;
// exit;
//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
    echo '<script>';
    echo 'window.location="admin_order.inc.php?do=success"';
    echo '</script>';  
    }else{
        echo '<script>';
        echo 'window.location="admin_order.inc.php"';
        echo '</script>';
    }


?>