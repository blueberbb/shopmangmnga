<?php

echo '<meta charset="utf-8">';
include('../connect/conndb.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();

$ref_m_id = mysqli_real_escape_string($conn, $_POST['ref_m_id']);
$p_name = mysqli_real_escape_string($conn, $_POST["p_name"]);
$ref_t_id = mysqli_real_escape_string($conn, $_POST["ref_t_id"]);
$p_intro = mysqli_real_escape_string($conn, $_POST["p_intro"]);
$p_detail = mysqli_real_escape_string($conn, $_POST["p_detail"]);
$p_price = mysqli_real_escape_string($conn, $_POST["p_price"]);
$p_view = mysqli_real_escape_string($conn, $_POST["p_view"]);
$p_qty = mysqli_real_escape_string($conn, $_POST["p_qty"]);
$p_m_name = mysqli_real_escape_string($conn, $_POST["p_m_name"]);
$p_m_edit_date = mysqli_real_escape_string($conn, $_POST["p_m_edit_date"]);
$p_datesave = mysqli_real_escape_string($conn, $_POST["p_datesave"]);


$date1 = date("Ymd_His");
$numrand = (mt_rand());
$m_pic = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
$upload = $_FILES['p_img']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img']['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    $path_link = "../img_product/" . $newname;
    move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
}

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$m_pic = (isset($_POST['p_img1']) ? $_POST['p_img1'] : '');
$upload = $_FILES['p_img1']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img1']['name'], ".");
    $newname1 = $numrand . $date1 . $type;
    $path_copy = $path . $newname1;
    $path_link = "../img_product/" . $newname1;
    move_uploaded_file($_FILES['p_img1']['tmp_name'], $path_copy);
}

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_pic = (isset($_POST['p_img2']) ? $_POST['p_img2'] : '');
$upload = $_FILES['p_img2']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img2']['name'], ".");
    $newname2 = $numrand . $date1 . $type;
    $path_copy = $path . $newname2;
    $path_link = "../img_product/" . $newname2;
    move_uploaded_file($_FILES['p_img2']['tmp_name'], $path_copy);
}

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_pic = (isset($_POST['p_img3']) ? $_POST['p_img3'] : '');
$upload = $_FILES['p_img3']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img3']['name'], ".");
    $newname3 = $numrand . $date1 . $type;
    $path_copy = $path . $newname3;
    $path_link = "../img_product/" . $newname3;
    move_uploaded_file($_FILES['p_img3']['tmp_name'], $path_copy);
}

//เช็คชื่อที่ใช้ล็อคอินซ้ำ
$check = "SELECT p_name FROM tbl_prd WHERE p_name = '$p_name'";
$result1 = mysqli_query($conn, $check);
$num = mysqli_num_rows($result1);

if ($num > 0) {
    echo '<script>';
    echo 'window.location="admin_prd.inc.php?do=check"';
    echo '</script>';
} else {
    $sql = "INSERT INTO tbl_prd
        (  
            
            p_img,
	        p_img1,
	        p_img2,
	        p_img3,
            p_name,
            ref_t_id,
            p_price,
            p_qty,
            p_intro,
            p_detail,
            ref_m_id
            
        )
        VALUES
        (   
            
           '$newname',
	       '$newname1',
	       '$newname2',
	       '$newname3',
           '$p_name',
           '$ref_t_id',
           '$p_price',
           '$p_qty',
           '$p_intro',
           '$p_detail',
            $ref_m_id
           
        )";

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    mysqli_close($conn);
}
if ($result) {
    echo '<script>';
    echo 'window.location="./admin_prd.inc.php?do=success"';
    echo '</script>';
} else {
    echo '<script>';
    echo 'window.location="./admin_prd.inc.php?do=fail"';
    echo '</script>';
}
