<?php
include('../connect/conndb.php');

    $bid = $_GET['bid'];

    $sql = "DELETE FROM tbl_bank WHERE bid = $bid";

    $result = mysqli_query($conn, $sql) or die("Error in sql : $sql" . mysqli_error($conn));
      
  mysqli_close($conn);
    
      if($result){
        echo '<script>';
        echo 'window.location="./admin_bank.inc.php?do=delete"';
        echo '</script>';  
        }else{
            echo '<script>';
            echo 'window.location="./admin_bank.inc.php"';
            echo '</script>';
        }
     
    ?>
