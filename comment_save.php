<?php
include_once('./Admin/connect/conndb.php');

echo '<meta charset="utf-8">';
// if (isset($_POST['submit'])) {
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
   $c_datail = mysqli_real_escape_string($conn, $_POST["c_datail"]);
   $ref_p_id = mysqli_real_escape_string($conn, $_POST["ref_p_id"]);
        
        $sql = "INSERT INTO tbl_comment
        (
            c_detail,
            ref_p_id
        )
        VALUES
        (
           '$c_datail',
            $ref_p_id
        )";

        $result = mysqli_query($conn, $sql) or die ("Error in query: $sql " . mysqli_error($conn));
    //    echo $sql;
    //    exit;

        mysqli_close($conn);
    
    if ($result) {
        echo "<script type='text/javascript'>";
        echo "window.location='detail.php?p_id=$ref_p_id';";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('Error !!!');";
        echo "window.location='detail.php?p_id=$ref_p_id';";
        echo "</script>";
    }

?>


