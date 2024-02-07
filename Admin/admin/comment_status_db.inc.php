<meta charset="utf-8">
<?php
//condb
include('../connect/conndb.php');

// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

// exit();

$c_id = $_GET["c_id"];
$c_status = $_GET['c_status'];

if ($c_status == 0) {
    //echo 'ปรับให้เป็นอนุมัติ';
    $sql = "UPDATE  tbl_comment SET 
		c_status=1
		WHERE c_id=$c_id";
} else {
    //echo 'ปรับให้เป็นรออนุมัติ';
    $sql = "UPDATE  tbl_comment SET 
		c_status=0
		WHERE c_id=$c_id";
}

$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));


// echo $sql;
// exit;

//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
    echo "<script type='text/javascript'>";
    //echo "alert('แก้ไขข้อมูลสำเร็จ');";
    echo "window.location = 'admin_comment.inc.php'; ";
    echo "</script>";
} else {
    echo "<script type='text/javascript'>";
    //echo "alert('Error!!');";
    echo "window.location = 'admin_comment.inc.php'; ";
    echo "</script>";
}
?>