<?php
echo '<meta charset="utf-8">';
include('../connect/conndb.php'); 
   	$bname = mysqli_real_escape_string($conn,$_POST["bname"]);
	$bnumber = mysqli_real_escape_string($conn,$_POST["bnumber"]);
	$bowner = mysqli_real_escape_string($conn,$_POST["bowner"]);
	
    $date1 = date("Ymd_His");
    $numrand = (mt_rand());
    $m_pic = (isset($_POST['b_img']) ? $_POST['b_img'] : '');
    $upload = $_FILES['b_img']['name'];

    if ($upload != '') {
        $path = "../img_bank/";
        $type = strrchr($_FILES['b_img']['name'], ".");
        $newname = $numrand . $date1 . $type;
        $path_copy = $path . $newname;
        $path_link = "../img_bank/" . $newname;
        move_uploaded_file($_FILES['b_img']['tmp_name'], $path_copy);
    }
    //เช็คชื่อที่ใช้ล็อคอินซ้ำ
    $check = "SELECT bname FROM tbl_bank WHERE bname = '$bname'";
    $result1 = mysqli_query($conn, $check);
    $num = mysqli_num_rows($result1);

    if ($num > 0) {
        echo '<script>';
        echo 'window.location="admin_table_bank.inc.php?do=check"';
        echo '</script>';
    } else {
	
	//เพิ่มเข้าไปในฐานข้อมูล
	$sql = "INSERT INTO tbl_bank
	(
    b_img,
    bname,
    bnumber,
	bowner
	
	)
	VALUES
	(
    '$newname',    
	'$bname',
	'$bnumber',
	'$bowner'
		)";
	$result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
	mysqli_close($conn);
    }
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	if($result){
	echo '<script>';
    echo 'window.location="./admin_bank.inc.php?do=success"';
    echo '</script>';
	}else{
        echo '<script>';
        echo 'window.location="./admin_bank.inc.php?do=fail"';
        echo '</script>';
}
?>