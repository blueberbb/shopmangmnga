<?php
session_start();
if (isset($_POST['m_username'])) {


   require_once('../connect/conndb.php');

   $m_username = $_POST['m_username'];
   $m_password = sha1($_POST['m_password']);


   $sql = "SELECT * FROM tbl_member WHERE m_username= '" . $m_username . "'
     AND m_password = '" . $m_password . "' ";

   //  echo $sql;
   //  exit;

   $result = mysqli_query($conn, $sql);


   if (mysqli_num_rows($result) == 1) {

      $row = mysqli_fetch_array($result);

      $_SESSION["m_id"] = $row["m_id"];
      $_SESSION["m_username"] = $row["m_username"];
      $_SESSION["m_img"] = $row["m_img"];
      $_SESSION["m_level"] = $row["m_level"];
      $_SESSION["m_name"] = $row["m_name"];
      $_SESSION["m_lname"] = $row["m_lname"];
      $_SESSION["m_email"] = $row["m_email"];
      $_SESSION["m_address"] = $row["m_address"];
      $_SESSION["m_phone"] = $row["m_phone"];
      $m_id = $_SESSION['m_id'];


      if ($_SESSION["m_level"] == "ADMIN") {
      

         

         echo '<script>';
         echo 'window.location="../admin/admin_page.inc.php?do=admin"';
         echo '</script>';
      }
      if ($_SESSION["m_level"] == "MEMBER") {
            //insert update log
            $ref_m_id = $_SESSION["m_id"];

            // echo 'ref_m_id ='.$ref_m_id;
            // exit;
   
            $sql2 = "INSERT INTO tbl_login_log
       (
       ref_m_id
       )
       VALUES
       (
       $ref_m_id
       )
       ";
       $result2 = mysqli_query($conn, $sql2) or die("Error in query:$sql2" . mysqli_error($conn));
         //  echo $sql2;
         //    exit;

         echo '<script>';
         echo 'window.location="../../index.php?do=member"';
         echo '</script>';
      }
   } else {
      echo '<script>';
      echo 'window.location="../../index.php?do=check"';
      echo '</script>';
   }
}
