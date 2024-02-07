<?php
include_once('../connect/conndb.php');
    $t_id  = $_POST["t_id"];
    $t_name = $_POST["t_name"];
    
    $check = "SELECT t_name FROM tbl_prd_type WHERE t_name = '$t_name'";
    $result1 = mysqli_query($conn, $check);
//  echo $check;
//  exit();
 $num = mysqli_num_rows($result1);
//  echo $num;
//  exit();
 if ($num > 0) {
     echo '<script>';
     echo 'window.location="./admin_type.inc.php?do=check"';
     echo '</script>';
    } else {
    $sql = "UPDATE tbl_prd_type SET t_name='$t_name' WHERE t_id = $t_id";

    $result = mysqli_query($conn, $sql) or die("Error in query:$sql" . mysqli_error($conn));
    mysqli_close($conn);
}
    if ($result) {
        echo '<script>';
        echo 'window.location="./admin_type.inc.php?do=edit"';
        echo '</script>';
    } else {
        echo '<script>';
        echo 'window.location="./admin_type.inc.php?do=fail"';
        echo '</script>';
    }



?>