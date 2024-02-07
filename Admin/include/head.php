<?php 
  session_start(); 
  include_once('./Admin/connect/conndb.php');
  $c_ipadr=$_SERVER['REMOTE_ADDR'];

  $sqlc = "INSERT INTO tbl_counter (c_ipadr) VALUES ('$c_ipadr')";

  $resultc = mysqli_query($conn, $sqlc) or die ("Error in query: $sqlc " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Ecommerce</title>
  
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="style2.css" />
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    .bg-alpha{
      background: rgba(0, 0, 0, 0.9);
    }
  </style>
</head>

<body style="background: #ffffff; font-family: 'Prompt', sans-serif;">
<?php
if ($_GET['do'] == 'member') {
  echo '<script tpye="text/javascript">
  Swal.fire({icon: "success",title: "เข้าสู่ระบบเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
  </script>';
  echo '<meta http-equiv="refresh" content="2;url=index.php">';
}

if ($_GET['do'] == 'check') {
  echo '<script tpye="text/javascript">
  Swal.fire({icon: "error",title: "User หรือ Password ไม่ถูกต้อง",showConfirmButton: false,timer: 3000})
  </script>';
  echo '<meta http-equiv="refresh" content="2;url=Admin/login.php">';
}

if ($_GET['do'] == 'logout') {
  echo '<script tpye="text/javascript">
  Swal.fire({icon: "success",title: "ออกจากระบบเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
  </script>';
  echo '<meta http-equiv="refresh" content="2;url=index.php">';
}
if ($_GET['do'] == 'logouta') {
  echo '<script tpye="text/javascript">
  Swal.fire({icon: "success",title: "ออกจากระบบเรียบร้อยแล้ว",showConfirmButton: false,timer: 3000})
  </script>';
  echo '<meta http-equiv="refresh" content="2;url=index.php">';
}


?>
 <?php
        
        /** ดึงข้อมูลสินค้า */
        $sql = "SELECT * FROM tbl_prd";
        $result = $conn->query($sql);

        /** เพิ่มข้อมูลสินค้าลงในตะกร้าแล้วหรือไม่ */
        if(isset($_GET['cart']) && ($_GET['cart'] == 'success')){
            echo "<script>
                    Swal.fire({
                        text: 'คุณได้ทำการเพิ่มสินค้าลงในตะกร้าแล้ว',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    window.history.replaceState(null, null, window.location.pathname)
                </script>";
        }
    ?>



<div class="container-fluid">
    <div class="row">
      <div class="col 12">