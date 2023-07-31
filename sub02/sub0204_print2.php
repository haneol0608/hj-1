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
    $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') ORDER BY qt_no * '+1', qt_no ASC, seq ASC, count DESC ";
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
  <div id="selectArea" class="sub_plate">

    <div class="flex">
        <h3>컷팅지 상세(Leg)</h3>
        <input type="button" onclick="history.back();" value="뒤로가기">
    </div>

    <div id="print" class="">
      <table>
        <thead>
          <tr>
            <td>SEQ</td>
            <td>수량</td>
            <td colspan="5">F . B<br>(LEG)65*9T</td>
            <td colspan="5">E . A<br>(LEG)65*65*8T</td>
            <td>PAD100</td>
            <td>PAD130</td>
            <td>R.B<br>Ø22</td>
            <td>R.B<br>Ø25</td>
            <td>HOOP<br>50*9T</td>
            <td>HOOP<br>Ø19</td>
            <td>PAINT</td>
            <td>호선</td>
            <td>POR.</td>
            <td>비고<br>No.</td>
          </tr>
        </thead>

        <tbody>
          <?php
            $a = 0;
            $counter = 1;
            $select_query = "SELECT * FROM hj_lada WHERE (lot_date = '$lot_date' AND list_lot = '$list_lot') ORDER BY  qt_no * '1' ASC, qt_no ASC, seq ASC, count DESC";
            $select_result = mysqli_query($conn, $select_query);
            while($row = mysqli_fetch_assoc($select_result)) {
              $a++;
              $seq = $row['seq'];
              $count = $row['count'];
              $leg1_one = $row['leg1_one'];
              $leg1_two = $row['leg1_two'];
              $leg1_three = $row['leg1_three'];
              $leg1_four = $row['leg1_four'];
              $leg1_five = $row['leg1_five'];
              $leg2_one = $row['leg2_one'];
              $leg2_two = $row['leg2_two'];
              $leg2_three = $row['leg2_three'];
              $leg2_four = $row['leg2_four'];
              $leg2_five = $row['leg2_five'];
              $pad_one = $row['pad_one'];
              $pad_two = $row['pad_two'];
              $RB22 = $row['RB22'];
              $RB25 = $row['RB25'];
              $hoop1 = $row['hoop1'];
              $hoop2 = $row['hoop2'];
              $paint = $row['paint'];
              $ho = $row['ho'];
              $por = $row['por'];
              $qt_no = $row['qt_no'];

              $count == 0 ? $count ='' : $count;
              $leg1_one == 0 ? $leg1_one = '' : $leg1_one;
              $leg1_five == 0 ? $leg1_five = '' : $leg1_five;
              $leg2_one == 0 ? $leg2_one = '' : $leg2_one;
              $leg2_five == 0 ? $leg2_five = '' : $leg2_five;
              // $pad_one == 0 ? $pad_one = '' : $pad_one;
              // $pad_two == 0 ? $pad_two = '' : $pad_two;
              // $RB22 == 0 ? $RB22 = '' : $RB22;
              // $RB25 == 0 ? $RB25 = '' : $RB25;
              $hoop1 == 0 ? $hoop1 = '' : $hoop1;
              $hoop2 == 0 ? $hoop2 = '' : $hoop2;
          ?>
          <!--********* 2022.11.30. 김한얼. 스타일 추가 *********-->
          <?php if($qtNo_arr[$qt_no] == '#DCDCDC') { ?>
            <tr style="background-color: #DCDCDC;">
          <?php } else { ?>
            <tr>
          <?php } ?>
          <!-- *********************************************** -->
            <td><?php echo $seq; ?></td>
            <td><?php echo $count; ?></td>
            <td><?php echo htmlspecialchars($leg1_one); ?></td>
            <td><?php echo htmlspecialchars($leg1_two); ?></td>
            <td><?php echo htmlspecialchars($leg1_three); ?></td>
            <td><?php echo htmlspecialchars($leg1_four); ?></td>
            <td><?php echo htmlspecialchars($leg1_five); ?></td>
            <td><?php echo htmlspecialchars($leg2_one); ?></td>
            <td><?php echo htmlspecialchars($leg2_two); ?></td>
            <td><?php echo htmlspecialchars($leg2_three); ?></td>
            <td><?php echo htmlspecialchars($leg2_four); ?></td>
            <td><?php echo htmlspecialchars($leg2_five); ?></td>
            <td><?php echo htmlspecialchars($pad_one); ?></td>
            <td><?php echo htmlspecialchars($pad_two); ?></td>
            <td><?php echo htmlspecialchars($RB22); ?></td>
            <td><?php echo htmlspecialchars($RB25); ?></td>
            <td><?php echo htmlspecialchars($hoop1); ?></td>
            <td><?php echo htmlspecialchars($hoop2); ?></td>
            <td><?php echo htmlspecialchars($paint); ?></td>
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
     document.innerHTML = selectArea.innerHTML;
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
