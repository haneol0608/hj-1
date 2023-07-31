<?php include "layout/header.php"; ?>

<?php
  $db['db_host'] = "27.96.135.94";
  $db['db_id'] = "root";
  $db['db_pw'] = "ghdls3450!";
  $db['db_name'] = "hj_marking";

  foreach($db as $key => $value) {
    define(strtoupper($key), $value);
  }

  $conn = mysqli_connect(DB_HOST, DB_ID, DB_PW, DB_NAME);
  mysqli_set_charset($conn, "utf8"); // 한글깨짐 방지

  // $insert_query = "INSERT INTO arduino SET ";
  // $insert_query .= "value1 = '4', ";
  // $insert_query .= "value2 = '테스트4', ";
  // $insert_query .= "date = '2022-11-16' ";
  //
  // $insert_result = mysqli_query($conn, $insert_query);
?>
<table>
  <thead>
    <tr>
      <td>번호</td>
      <td>호선</td>
      <td>POR</td>
      <td>상태</td>
      <td>SEQ</td>
      <td>페인트</td>
      <td>수량</td>
    </tr>
  </thead>

  <tbody>
    <?php
      $select_query = "SELECT * FROM hj_label";
      $select_result = mysqli_query($conn, $select_query);
      while($row = mysqli_fetch_assoc($select_result)) {
        $no = $row['no'];
        $la_no = $row['la_no'];
        $por = $row['por'];
        $ho = $row['ho'];
        $seq = $row['seq'];
        $paint = $row['paint'];
        $other = $row['other'];
        $count = $row['count'];
        $date = $row['date'];
        $stat = $row['stat'];
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <td><?php echo $ho; ?></td>
      <td><?php echo $por; ?></td>
      <td><?php echo $stat; ?></td>
      <td><?php echo $seq; ?></td>
      <td><?php echo $paint; ?></td>
      <td><?php echo $count; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>


