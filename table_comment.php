<?php
      $query = "SELECT * FROM tbl_comment WHERE ref_p_id=$p_id ORDER BY c_date DESC" or die("Error:" . mysqli_error($conn));
      $result = mysqli_query($conn, $query);

      ?>
      <table class="table">
        <thead class="bg-primary">
          <th scope="col">#</th>
          <th scope="col">แสดงความคิดเห็น</th>
          <th scope="col">ว-ด-ป</th>
        </thead>
        <?php
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
        ?>
          <tbody>
            <tr>
              <td class="text-center"><?php echo $i; ?></td>
              <td class="text-center"><?php echo $row['c_detail']; ?></td>
              <td class="text-center"><?php echo date('d-m-Y', strtotime($row['c_date'])); ?></td>
            </tr>
          <?php
          $i++;
        }
          ?>
          </tbody>
      </table>