<?php

include('../connect/conndb.php');

    $t_id = $_GET['t_id'];

    $sql = "DELETE FROM tbl_prd_type WHERE t_id = $t_id";

    $result = mysqli_query($conn, $sql) or die("Error in sql : $sql" . mysqli_error($conn));
      
  mysqli_close($conn);
    
      if($result){
        echo '<script>';
        echo 'window.location="./admin_type.inc.php?do=delete"';
        echo '</script>';  
        }else{
            echo '<script>';
            echo 'window.location="./admin_type.inc.php"';
            echo '</script>';
        }
     
    ?>

