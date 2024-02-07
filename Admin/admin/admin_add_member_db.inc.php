<?php

echo '<meta charset="utf-8">';
include('../connect/conndb.php');
    
    $m_username = mysqli_real_escape_string($conn, $_POST["m_username"]);
    $m_password = mysqli_real_escape_string($conn, sha1($_POST["m_password"]));
    $m_fname = mysqli_real_escape_string($conn, $_POST["m_fname"]);
    $m_name = mysqli_real_escape_string($conn, $_POST["m_name"]);
    $m_lname = mysqli_real_escape_string($conn, $_POST["m_lname"]);
    $m_email = mysqli_real_escape_string($conn, $_POST["m_email"]);
    $m_phone = mysqli_real_escape_string($conn, $_POST["m_phone"]);
    $m_address = mysqli_real_escape_string($conn, $_POST["m_address"]);
    $m_level = mysqli_real_escape_string($conn, $_POST["m_level"]);

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
    }


    //เช็คชื่อที่ใช้ล็อคอินซ้ำ
    $check = "SELECT m_username FROM tbl_member WHERE m_username = '$m_username'";
    $result1 = mysqli_query($conn, $check);
    $num = mysqli_num_rows($result1);

    if ($num > 0) {
        echo '<script>';
        echo 'window.location="admin_member.inc.php?do=check"';
        echo '</script>';
    } else {
        $sql = "INSERT INTO tbl_member
        (
            m_username,
            m_password,
            m_fname,
            m_name,
            m_lname,
            m_email,
            m_phone,
            m_address,
            m_img,
            m_level
        )
        VALUES
        (
           '$m_username',
           '$m_password',
           '$m_fname',
           '$m_name',
           '$m_lname',
           '$m_email',
           '$m_phone',
           '$m_address',
           '$newname',
           '$m_level'
        )";

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    mysqli_close($conn);
    }
    if ($result) {
      echo '<script>';
      echo 'window.location="./admin_member.inc.php?do=success"';
      echo '</script>';
    } else {
        echo '<script>';
      echo 'window.location="./admin_member.inc.php?do=fail"';
      echo '</script>';
    }



?>