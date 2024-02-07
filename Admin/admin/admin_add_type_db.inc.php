<?php

echo '<meta charset="utf-8">';
// if (isset($_POST['submit'])) {
include('../connect/conndb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();


   $t_name = mysqli_real_escape_string($conn, $_POST["t_name"]);
    
    // //เช็คประเภทสินค้าซ้ำ
    $check = "SELECT t_name FROM tbl_prd_type
    WHERE t_name = '$t_name'
    ";
    $result1 = mysqli_query($conn, $check);
    // echo $check;
    // exit();
    $num = mysqli_num_rows($result1);
    // echo $num;
    // exit();
    if ($num > 0) {
        echo '<script>';
        echo 'window.location="./admin_type.inc.php?do=check"';
        echo '</script>';
        
    } else {
        $sql = "INSERT INTO tbl_prd_type
        (
            t_name
        )
        VALUES
        (
           '$t_name'
        )";

        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
        mysqli_close($conn);
    }
    if ($result) {
        echo '<script>';
        echo 'window.location="./admin_type.inc.php?do=success"';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'window.location="./admin_type.inc.php?do=check"';
        echo '</script>';
    }

?>