<meta charset="utf-8">
<?php
//condb
include_once('../connect/conndb.php');
// print_r($_POST);
// echo '<hr>';
// exit;
$o_id = mysqli_real_escape_string($conn, $_GET["o_id"]);

$sql = "UPDATE order_head SET o_status=4 WHERE o_id=$o_id ";

$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));

// echo $sql;
// exit;
//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
    echo '<script>';
    echo 'window.location="admin_order.inc.php?do=delete"';
    echo '</script>';
}else{
echo "<script type='text/javascript'>";
echo "alert('Error!!');";
echo "window.location = 'admin_order.inc.php'; ";
echo "</script>";
}


?>