<?php
// session_start();
$conn = mysqli_connect("localhost", "root", "", "ecom1") or die("Error: " . mysqli_error($conn));
$conn->set_charset("utf8");
error_reporting(0);
date_default_timezone_set('Asia/Bangkok');
