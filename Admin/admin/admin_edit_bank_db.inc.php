<?php

echo '<meta charset="utf-8">';
include('../connect/conndb.php');
 

    $bname = $_POST["bname"];
    $bnumber = $_POST["bnumber"];
    $bowner = $_POST["bowner"];
    $b_img2 = $_POST["b_img2"];
    $bid  = $_POST["bid"];
 


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
    } else {
        $newname = $b_img2;
    }


    //เช็คชื่อที่ใช้ล็อคอินซ้ำ

    $sql = "UPDATE tbl_bank SET 
        
            b_img='$newname',
            bname='$bname',
            bnumber='$bnumber',
	        bowner='$bowner'
	        WHERE bid=$bid
            ";

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    mysqli_close($conn);

    if ($result) {
        echo '<script>';
        echo 'window.location="./admin_bank.inc.php?do=edit"';
        echo '</script>';
    } else {
      echo '<script>';
      echo 'window.location="./admin_bank.inc.php?do=fail"';
      echo '</script>';
    }
