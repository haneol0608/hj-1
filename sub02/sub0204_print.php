<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- style -->
<!-- <link rel="stylesheet" href="/hj/include/css/reset.css"> -->
<link rel="stylesheet" href="/hj/include/css/print.css">
<link rel="stylesheet" href="/hj/include/css/style_mes.css">
<link rel="stylesheet" href="/hj/include/css/lightgallery.css">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="/hj/include/js/common.js"></script>

<div style="display: none;">
  <?php include '../include/dbcon.php'; ?>
</div>

<?php
  //*********************************************************** 2022-11-30. 김한얼. 스타일 -> 배열화 ***********************************************************//
  $w = $_GET['w'];
  $p = $_GET['p'];

  $enc_lotDate = $_GET['lot_date'];
  $enc_listLot = $_GET['list_lot'];

  $lot_date = base64_decode($_GET['lot_date']);
  $list_lot = base64_decode($_GET['list_lot']);

  if($lot_date == null && $list_lot == null) {
    $lot_date = null;
    $list_lot = null;
  }

  // 1. 배열 화 -> 중복 제거
  $qtNo_arr = array();
  $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') AND (w = '$w' AND p= '$p') ORDER BY qt_no * '+1', qt_no ASC, seq ASC, count DESC";
  $select_result = mysqli_query($conn, $select_query);
  while($row = mysqli_fetch_assoc($select_result)) {
    $qt_no = $row['qt_no'];
    array_push($qtNo_arr, $qt_no);
  }
  $qtNo_arr = array_unique($qtNo_arr);

  // 2. key 값 재정의
  $i = 0;
  foreach($qtNo_arr as $key => $val) {
    unset($qtNo_arr[$key]);
    $new_key = $i;
    $qtNo_arr[$new_key] = $val;

    $i++;
  }

  // 3. key 값 재정의 2
  $qtNo_arr = array_flip($qtNo_arr);
  foreach ( $qtNo_arr as $key => &$value ) {
    $value = $value & 1 ? '#DCDCDC' : 'white';
  }
  // ******************************************************************************************************************************************************//
?>
  <div class="">

    <div class="flex">
        <h3>컷팅지 상세(W - <?php echo $w; ?> / P - <?php echo $p; ?>)</h3>
        <input type="button" onclick="history.back();" value="뒤로가기">
    </div>

    <div id="print" class="">
      <table>
        <thead>
          <tr>
            <td>사상</td>
            <td>SEQ</td>
            <td>수량</td>
            <td colspan="5">F . B<br>(FRAME)65*9T</td>
            <td>U</td>
            <td>B</td>
            <td>각철<br>수량</td>
            <td>호선</td>
            <td>POR.</td>
            <td>비고<br>No.</td>
          </tr>
        </thead>

        <tbody>
          <?php
            $a = 0;
            $counter = 1;
            $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') AND (w = '$w' AND p= '$p' AND lot_date = '$lot_date' AND list_lot = '$list_lot') ORDER BY qt_no * '1' ASC, qt_no ASC, seq ASC, count DESC";
            $select_result = mysqli_query($conn, $select_query);
            while($row = mysqli_fetch_assoc($select_result)) {
              $a++;
              $lap = $row['lap'];
              $seq = $row['seq'];
              $count = $row['count'];
              $fr_one = $row['fr_one'];
              $fr_one = $row['fr_one'];
              $fr_two = $row['fr_two'];
              $fr_three = $row['fr_three'];
              $fr_four = $row['fr_four'];
              $fr_five = $row['fr_five'];
              $U = $row['U'];
              $B = $row['B'];
              $gak_count = $row['gak_count'];
              $ho = $row['ho'];
              $por = $row['por'];
              $qt_no = $row['qt_no'];
          ?>
            <!--********* 2022.11.30. 김한얼. 스타일 추가 *********-->
            <?php if($qtNo_arr[$qt_no] == '#DCDCDC') { ?>
            <tr style="background-color: #DCDCDC;">
            <?php } else { ?>
              <tr>
            <?php } ?>
            <!-- *********************************************** -->
            <td><?php echo $lap; ?></td>
            <td><?php echo $seq; ?></td>
            <td><?php echo $count; ?></td>
            <td><?php echo htmlspecialchars($fr_one); ?></td>
            <td><?php echo htmlspecialchars($fr_two); ?></td>
            <td><?php echo htmlspecialchars($fr_three); ?></td>
            <td><?php echo htmlspecialchars($fr_four); ?></td>
            <td><?php echo htmlspecialchars($fr_five); ?></td>
            <td><?php echo htmlspecialchars($U); ?></td>
            <td><?php echo htmlspecialchars($B); ?></td>
            <td><?php echo htmlspecialchars($gak_count); ?></td>
            <td><?php echo $ho; ?></td>
            <td><?php echo $por; ?></td>
            <td><?php echo $qt_no; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


<script type="text/javascript">
  function printPage() {
    window.print();
  }
  printPage();
  function beforePrint() {
    initBodyHtml = document.body.innerHTML;
    document.body.innerHTML = document.getElementById('print').innerHTML;
  }
  function afterPrint() {
    document.body.innerHTML = initBodyHtml;
  }
  // window.onbeforeprint = beforePrint();
  window.onafterprint = afterprint();
</script>

<div style="display: none;">
  <?php include "../layout/footer.php"; ?>
</div>
