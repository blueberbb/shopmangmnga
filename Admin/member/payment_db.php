<meta charset="utf-8">
<?php
//condb

include_once('../connect/conndb.php');
include('member_head.inc.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';

// exit();



$bid = mysqli_real_escape_string($conn, $_POST["bid"]);
$o_slip_date = mysqli_real_escape_string($conn, $_POST["o_slip_date"]);
$o_slip_total = mysqli_real_escape_string($conn, $_POST["o_slip_total"]);
$o_id= mysqli_real_escape_string($conn, $_POST["o_id"]);


$date1 = date("Ymd_His");
$numrand = (mt_rand());

$o_slip = (isset($_POST['o_slip']) ? $_POST['o_slip'] : '');
$upload = $_FILES['o_slip']['name'];
if ($upload != '') {
	//โฟลเดอร์ที่เก็บไฟล์
	$path = "../img_slip/";//ชื่อโฟเดอร์ที่เก็บไฟล์
	//ตัวขื่อกับนามสกุลภาพออกจากกัน
	$type = strrchr($_FILES['o_slip']['name'], ".");
	//ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	$newname ='slip_'. $numrand . $date1 . $type;
	$path_copy = $path . $newname;
	$path_link = "../img_slip/" . $newname;//ชื่อโฟเดอร์ที่เก็บไฟล์
	//คัดลอกไฟล์ไปยังโฟลเดอร์
	move_uploaded_file($_FILES['o_slip']['tmp_name'], $path_copy);
} else {
	$newname = '';
}

//update data 
$sql = "UPDATE order_head SET 
	bid='$bid',
    o_slip_date='$o_slip_date',
    o_slip_total='$o_slip_total',
    o_status=2,
    o_slip='$newname'

	WHERE o_id=$o_id 
	 ";

$result = mysqli_query($conn, $sql) or die("Error in query: $sql " . mysqli_error($conn));

// echo '<pre>';
// echo $sql;
// echo '</pre>';
// exit;

//ปิดการเชื่อมต่อ database
mysqli_close($conn);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if ($result) {
   
	echo "<script type='text/javascript'>";
	echo "alert('แจ้งชำระเงินเรียบร้อยแล้ว');";
	echo "window.location = 'member_payment_detail.inc.php?o_id=$o_id'; ";
	echo "</script>";
} else {
	echo "<script type='text/javascript'>";
	echo "alert('Error!!');";
	echo "window.location = 'member_page.inc.php'; ";
	echo "</script>";
}
?>