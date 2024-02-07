<?php
include('../connect/conndb.php');

    $m_id = $_GET['m_id'];

    $sql = "DELETE FROM tbl_member WHERE m_id = $m_id";

    $result = mysqli_query($conn, $sql) or die("Error in sql : $sql" . mysqli_error($conn));
      
  mysqli_close($conn);
    
      if($result){
        echo '<script>';
        echo 'window.location="./admin_member.inc.php?do=delete"';
        echo '</script>';  
        }else{
            echo '<script>';
            echo 'window.location="./admin_member.inc.php"';
            echo '</script>';
        }
     
    ?>

