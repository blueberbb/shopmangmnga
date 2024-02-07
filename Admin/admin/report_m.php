<?php
$query = "SELECT SUM(o_total) AS total, DATE_FORMAT(o_dttm, '%M-%Y') AS o_dttm
            FROM order_head WHERE o_status IN (2,3)
            GROUP BY DATE_FORMAT(o_dttm, '%Y-%m')
            ORDER BY DATE_FORMAT(o_dttm, '%Y-%m') DESC
            ";
$result = mysqli_query($conn, $query);
$resultchart = mysqli_query($conn, $query);
//for chart
$o_dttm = array();
$total = array();
while ($rs = mysqli_fetch_array($resultchart)) {
    $o_dttm[] = "\"" . $rs['o_dttm'] . "\"";
    $total[] = "\"" . $rs['total'] . "\"";
}
$o_dttm = implode(",", $o_dttm);
$total = implode(",", $total);
?>
<h3 align="center">รายงานแยกตามเดือน </h3>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<hr>
<p align="center">
    <!--devbanban.com-->
    <canvas id="myChart" width="800px" height="300px"></canvas>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $o_dttm; ?>

                ],
                datasets: [{
                    label: 'รายงานรายได้ แยกตามเดือน (บาท)',
                    data: [<?php echo $total; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</p>

<table id="dt-basic-example" class=" table table-bordered table-hover table-striped w-100">
                                <thead class="bg-primary-600">
            <tr >
                <th width="20%">แยกตามเดือน</th>
                <th width="10%">
                    <center>รายได้</center>
                </th>
            </tr>
        </thead>

        <?php
        $ototal = 0;
        while ($row2 = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $row2['o_dttm']; ?></td>
                <td align="right">฿<?php echo number_format($row2['total'], 2); ?></td>
            </tr>
        <?php $ototal += $row2['total'];
        }
        ?>
        <tr class="table-dark">
            <td align="center" class="bg-dark">รวม</td>
            <td align="right" class="bg-dark"><b>
            ฿<?php echo number_format($ototal, 2); ?></b></td>
            </td>
        </tr>
    </table>

<?php mysqli_close($conn); ?>