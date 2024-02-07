<?php
session_start();
include('./Admin/connect/conndb.php');
if ($_SESSION['m_name'] == '') {

    echo "<script type='text/javascript'>";
    echo "alert('คุณยังไม่ได้เข้าสู่ระบบ');";
    echo "window.location = './Admin/login.php'; ";
    echo "</script>";
}

?>


<meta charset=utf-8 />


<!--สร้างตัวแปรสำหรับบันทึกการสั่งซื้อ -->
<?php
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';


$name = mysqli_real_escape_string($conn, $_POST["m_name"]);
$address = mysqli_real_escape_string($conn, $_POST["m_address"]);
$email = mysqli_real_escape_string($conn, $_POST["m_email"]);
$phone = mysqli_real_escape_string($conn, $_POST["m_phone"]);
$m_id = mysqli_real_escape_string($conn, $_POST["m_id"]);
//$total_qty = $_POST["total_qty"];
$total = mysqli_real_escape_string($conn, $_POST["total"]);
$dttm = Date("Y-m-d G:i:s");
//บันทึกการสั่งซื้อลงใน order_detail
mysqli_query($conn, "BEGIN");
$sql1    = "INSERT INTO order_head
     VALUES
     (
         null,
          $m_id,
         '$dttm',
         '$name',
         '$address',
         '$email',
         '$phone',
         '$total',
          1,
          0,
          '',
          '0000-00-00',
          0,
          '',
          '0000-00-00'
          )";
$query1 = mysqli_query($conn, $sql1) or die("Error in query: $sql1" . mysqli_error($conn));

$sql2 = "SELECT MAX(o_id) as o_id 
    FROM order_head
    WHERE m_id= $m_id
    AND o_dttm='$dttm' ";

$query2    = mysqli_query($conn, $sql2);
$row = mysqli_fetch_array($query2);
$o_id = $row["o_id"];

foreach ($_SESSION['cart'] as $p_id => $qty) {
    $sql3 = "SELECT * FROM tbl_prd WHERE p_id=$p_id";
    $query3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($query3);
    $total = $row3['p_price'] * $qty;
    $count = mysqli_num_rows($query3);

    $sql4 = "INSERT INTO order_detail
         VALUES
         (
             null,
             $o_id,
             $p_id,
             $qty,
             $total
             )";
    $query4 = mysqli_query($conn, $sql4);


    for ($i = 0; $i < $count; $i++) {
        $instock =  $row3['p_qty'];

        $updatestock = $instock - $qty;

        $sql5 = "UPDATE tbl_prd SET  
            p_qty=$updatestock
            WHERE  p_id=$p_id ";
        $query5 = mysqli_query($conn, $sql5) or die("Error in query: $sql1" . mysqli_error($conn));
    }

    /*   stock  */
}

// exit;

if ($query1 && $query4) {
    mysqli_query($conn, "COMMIT");
    $msg = "สั่งซื้อสินค้าเรียบร้อยแล้ว ";
    foreach ($_SESSION['cart'] as $p_id) {
        //unset($_SESSION['cart'][$p_id]);
        unset($_SESSION['cart']);
    }
} else {
    mysqli_query($conn, "ROLLBACK");
    $msg = "สั่งซื้อสินค้าไม่สำเร็จ กรุณาติดต่อเจ้าหน้าที่ค่ะ ";
}
?>
<script type="text/javascript">
    alert("<?php echo $msg; ?>");
    window.location = 'Admin/member/member_order_detail.inc.php?o_id=<?php echo $o_id; ?>';
</script>