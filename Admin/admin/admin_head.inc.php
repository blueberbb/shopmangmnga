<?php
session_start();
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
 include_once('../connect/conndb.php');
 $m_id = $_SESSION['m_id'];
 $m_username = $_SESSION['m_username'];
 $m_img = $_SESSION['m_img'];
 $m_level = $_SESSION['m_level'];
 $m_name = $_SESSION['m_name'];
 $m_lname = $_SESSION['m_lname'];
 $m_email = $_SESSION['m_email'];
 $m_address = $_SESSION['m_address'];
 $m_phone = $_SESSION['m_phone'];


 
$sql = "SELECT * FROM tbl_member WHERE m_id=$m_id";
$result = mysqli_query($conn, $sql) or die ("Error in query: $ sql " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
extract($row);
$m_img = $row['m_img'];
$m_username = $row['m_username'];
// echo $m_username;

// echo '<pre>';
// print_r($_row);
// echo '</pre>';
 
if ($m_level != 'ADMIN') {
    Header("Location:../../index.php");
}