<?php
// $query = "SELECT * FROM tbl_comment 
// WHERE ref_p_id=$p_id
// AND c_status=1
// ORDER BY c_date DESC" or die("Error:" . mysqli_error($conn));
// $result = mysqli_query($conn, $query);  
$query ="SELECT * FROM tbl_comment ORDER BY c_id DESC" or die("Error:" . mysqli_error($conn));
$result = mysqli_query($conn, $query);
//echo "<div style='overflow-x:auto;'>";//คำสั่งทำให้ตาราเป็น เรสปอน
echo "<table id='dt-basic-example' class=' table table-bordered table-hover table-striped w-100'>";
//หัวข้อตาราง

echo "
<thead>
<tr align='center' class='bg-primary'>
<th width='5%'>รหัส</th>
<th width='55%'>ความคิดเห็น</th>
<th width='10%'>สถานะ</th>
<th width='10%'>ว/ด/ป</th>
<th width='10%'>แก้ไข</th>
</tr>
</thead>
";
while($row = mysqli_fetch_array($result)) { 
  echo "<tr>";
  echo "<td align='center'>" .$row["c_id"] .'.'. "</td> "; 
  echo "<td >"; 
  echo $row["c_detail"]; 
  echo "<a href='admin_edit_prd.inc.php?p_id=$row[ref_p_id]&c_status=$c_status' class='btn btn-success btn-xs' target='_bank'>OPEN</a>";
  echo "</td>";
  echo "<td align='center'>"; 
  $c_status = $row["c_status"];
  if($c_status==0){
    echo '<font color="#ef8204">';
    echo 'รออนุมัติ';
    echo '</font>';
  }else{
    echo '<font color="#03fc3d">';
    echo 'อนุมัติ';
    echo '</font>';
  }
  echo "</td> ";
  echo "<td align='center'>" .$row["c_date"] .  "</td> "; 
  //แก้ไขข้อมูล
  echo "<td align='center'>
  <a href='comment_status_db.inc.php?c_id=$row[0]&c_status=$c_status' class='btn btn-warning btn-xs'>ปรับสถานะ</a></td> ";
  echo "</tr>";
}
echo "</table>";
// echo "</div>";
//5. close connection
mysqli_close($conn);
?>