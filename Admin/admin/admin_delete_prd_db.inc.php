<?php
include('../connect/conndb.php');

    $p_id = $_GET['p_id'];

    $sql = "DELETE FROM tbl_prd WHERE p_id = $p_id";

    $result = mysqli_query($conn, $sql) or die("Error in sql : $sql" . mysqli_error($conn));
      
  mysqli_close($conn);
    
      if($result){
        echo '<script>';
        echo 'window.location="./admin_prd.inc.php?do=delete"';
        echo '</script>';  
        }else{
            echo '<script>';
            echo 'window.location="./admin_prd.inc.php"';
            echo '</script>';
        }
     
    ?>