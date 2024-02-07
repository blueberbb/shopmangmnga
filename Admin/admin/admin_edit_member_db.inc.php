<?php

echo '<meta charset="utf-8">';
include('../connect/conndb.php');

   

    $m_username = $_POST["m_username"];
    $m_fname = $_POST["m_fname"];
    $m_name = $_POST["m_name"];
    $m_lname = $_POST["m_lname"];
    $m_email = $_POST["m_email"];
    $m_phone = $_POST["m_phone"];
    $m_address = $_POST["m_address"];
    $m_level = $_POST["m_level"];
    $m_img2 = $_POST["m_img2"];
    $m_id  = $_POST["m_id"];



    $date1 = date("Ymd_His");
    $numrand = (mt_rand());
    $m_pic = (isset($_POST['m_img']) ? $_POST['m_img'] : '');
    $upload = $_FILES['m_img']['name'];

    if ($upload != '') {
        $path = "../profile/";
        $type = strrchr($_FILES['m_img']['name'], ".");
        $newname = $numrand . $date1 . $type;
        $path_copy = $path . $newname;
        $path_link = "../profile/" . $newname;
        move_uploaded_file($_FILES['m_img']['tmp_name'], $path_copy);
    } else {
        $newname = $m_img2;
    }


    //เช็คชื่อที่ใช้ล็อคอินซ้ำ

    $sql = "UPDATE tbl_member SET 
        
            m_username='$m_username',
            m_fname='$m_fname',
            m_name='$m_name',
	        m_lname='$m_lname',
	        m_email='$m_email',
	        m_phone='$m_phone',
	        m_address='$m_address',
	        m_img='$newname',
	        m_level='$m_level'
	        WHERE m_id=$m_id
            ";

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    mysqli_close($conn);

    if ($result) {
        echo '<script>';
        echo 'window.location="./admin_member.inc.php?do=edit"';
        echo '</script>';
    } else {
      echo '<script>';
      echo 'window.location="./admin_member.inc.php?do=fail"';
      echo '</script>';
    }
