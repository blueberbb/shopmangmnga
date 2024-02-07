<?php
$query = "SELECT * FROM tbl_comment 
WHERE ref_p_id=$p_id
AND c_status=1
ORDER BY c_date DESC" or die("Error:" . mysqli_error($conn));
$result = mysqli_query($conn, $query); 

?>
<table class="table">
  <thead class="bg-primary">
    <th scope="col">#</th>
    <th scope="col" style="font-family: 'Prompt', sans-serif;">แสดงความคิดเห็น</th>
    <th scope="col" style="font-family: 'Prompt', sans-serif;">ว-ด-ป</th>
  </thead>
  <?php
  $i = 1;
  while ($row = mysqli_fetch_array($result)) {
  ?>
    <tbody>
      <tr>
        <td class="text-center"><?php echo $i; ?></td>
        <td class="text-center" style="font-family: 'Prompt', sans-serif;"><?php echo $row['c_detail']; ?></td>
        <td class="text-center" style="font-family: 'Prompt', sans-serif;"><?php echo date('d-m-Y H:i:s', strtotime($row['c_date'])); ?></td>
      </tr>
    <?php
    $i++;
  }
    ?>
    </tbody>
</table>