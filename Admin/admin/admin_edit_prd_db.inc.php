<meta charset="utf-8">
<?php
include('../connect/conndb.php');

// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
// exit();

$ref_m_id = $_POST["ref_m_id"];
$p_name = $_POST["p_name"];
$ref_t_id = $_POST["ref_t_id"];
$p_intro = $_POST["p_intro"];
$p_detail = $_POST["p_detail"];
$p_price = $_POST["p_price"];
$p_view = $_POST["p_view"];
$p_qty = $_POST["p_qty"];
$p_m_name = $_POST["p_m_name"];
$p_m_edit_date = $_POST["p_m_edit_date"];
$p_datesave = $_POST["p_datesave"];
$p_id = $_POST["p_id"];
$p_img5 = $_POST["p_img5"];
$p_img6 = $_POST["p_img6"];
$p_img7 = $_POST["p_img7"];
$p_img8 = $_POST["p_img8"];

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_img = (isset($_POST['p_img']) ? $_POST['p_img'] : '');
$upload = $_FILES['p_img']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img']['name'], ".");
    $newname = $numrand . $date1 . $type;
    $path_copy = $path . $newname;
    $path_link = "../img_product/".$newname;
    move_uploaded_file($_FILES['p_img']['tmp_name'], $path_copy);
}else{
    $newname=$p_img5;
}

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_img1 = (isset($_POST['p_img1']) ? $_POST['p_img1'] : '');
$upload = $_FILES['p_img1']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img1']['name'], ".");
    $newname1 = $numrand . $date1 . $type;
    $path_copy = $path . $newname1;
    $path_link = "../img_product/".$newname1;
    move_uploaded_file($_FILES['p_img1']['tmp_name'], $path_copy);
}else{
    $newname1=$p_img6;
}

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_img2 = (isset($_POST['p_img2']) ? $_POST['p_img2'] : '');
$upload = $_FILES['p_img2']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img2']['name'], ".");
    $newname2 = $numrand . $date1 . $type;
    $path_copy = $path . $newname2;
    $path_link = "../img_product/".$newname2;
    move_uploaded_file($_FILES['p_img2']['tmp_name'], $path_copy);
}else{
    $newname2=$p_img7;
}

$date1 = date("Ymd_His");
$numrand = (mt_rand());
$p_img3 = (isset($_POST['p_img3']) ? $_POST['p_img3'] : '');
$upload = $_FILES['p_img3']['name'];

if ($upload != '') {
    $path = "../img_product/";
    $type = strrchr($_FILES['p_img3']['name'], ".");
    $newname3 = $numrand . $date1 . $type;
    $path_copy = $path . $newname3;
    $path_link = "../img_product/".$newname3;
    move_uploaded_file($_FILES['p_img3']['tmp_name'], $path_copy);
}else{
    $newname3=$p_img8;
}

    $sql = "UPDATE tbl_prd SET 
            p_img='$newname',
	        p_img1='$newname1',
	        p_img2='$newname2',
	        p_img3='$newname3',
            p_name='$p_name',
            ref_t_id='$ref_t_id',
            p_price='$p_price',
            p_qty='$p_qty',
            p_intro='$p_intro',
            p_detail='$p_detail',
            ref_m_id='$ref_m_id',
            p_m_name='$p_m_name',
            p_m_edit_date='$p_m_edit_date'
            WHERE p_id=$p_id
        ";
                  

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));

    //insert update log
    $sql2 = "INSERT INTO tbl_prd_update_log
    (
    ref_p_id,
    ref_m_id
    )
    VALUES
    (
    $p_id,
    $ref_m_id
    )
    ";
          
    $result2 = mysqli_query($conn, $sql2) or die("Error in query:$sql2" . mysqli_error($conn));



    mysqli_close($conn);

if ($result) {
    echo '<script>';
    echo 'window.location="./admin_prd.inc.php?do=edit"';
    echo '</script>';
} else {
    echo '<script>';
    echo 'window.location="./admin_prd.inc.php?do=fail"';
    echo '</script>';
}
