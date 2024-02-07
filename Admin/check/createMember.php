<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Document</title>
</head>

<body>

    <?php
    require_once('../connect/conndb.php');

    if (isset($_POST['submit'])) {
        $check_sql = "SELECT * FROM tbl_member WHERE m_username = '" . $_POST['m_username'] . "'";
        $check_m_username = $conn->query($check_sql) or die($conn->error);

        if (!$check_m_username->num_rows) {
            $hashed_password = password_hash($_POST['m_password'], PASSWORD_DEFAULT);
            $sql_create = "INSERT INTO `tbl_member` (`m_username`, `m_password`, `m_fname`, `m_name`, `m_lname`, `m_email`, `m_phone`,`m_level`, `m_datesave`)
                         VALUES ('" . $_POST['m_username'] . "',
                                 '" . $hashed_password . "',
                                 '" . $_POST['m_fname'] . "',
                                 '" . $_POST['m_name'] . "',
                                 '" . $_POST['m_lname'] . "',
                                 '" . $_POST['m_email'] . "',
                                 '" . $_POST['m_phone'] . "',
                                 '" . $_POST['m_level'] . "',
                                 '" . date("Y-m-d") . "' );";
            $result = $conn->query($sql_create) or die($conn->error);

            echo "<script>";
            echo "Swal.fire({
                icon: 'success',
                title: 'สมัครสมาชิกเรียบร้อยแล้ว',
                showConfirmButton: false,
                timer: 2000
            }).then((result) => {
                if (result.isDismissed){
                    window.location.href = '../login.php';
            }
            })";
            echo "</script>";
        } else {
            echo "<script>";
            echo "Swal.fire({
            icon: 'warning',
            title: 'Username ซ้ำกรุณากรอกใหม่',
            showConfirmButton: false,
            timer: 3000
        }).then((result) => {
            if (result.isDismissed){
                window.location.href = '../register.php';
        }
        })";
            echo "</script>";
        }
    }
    ?>
</body>

</html>