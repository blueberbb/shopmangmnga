<?php
session_start();
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
$result = mysqli_query($conn, $sql) or die("Error in query: $ sql " . mysqli_error($conn));
$row = mysqli_fetch_array($result);
extract($row);
$m_img = $row['m_img'];
$m_username = $row['m_username'];

//ดึงข้อมูลล็อคอินมาโชว์
$sql2 = "SELECT * FROM tbl_login_log
WHERE ref_m_id=$m_id
ORDER BY log_id DESC
LIMIT 1
";
$result2 = mysqli_query($conn, $sql2) or die("Error in query: $ sql2 " . mysqli_error($conn));
$row = mysqli_fetch_array($result2);
extract($row);

$lastlogin = $row['log_date'];

if ($m_level != 'MEMBER') {
    Header("Location:../../index.php");
}
