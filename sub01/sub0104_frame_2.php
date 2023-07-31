<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php
//*********************************************************** 2022-11-30. 김한얼. 스타일 -> 배열화 ***********************************************************//
 $w = $_GET['w'];
 $p = $_GET['p'];

 // 1. 배열 화 -> 중복 제거
 $qtNo_arr = array();
 $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B WHERE (B.w = '$w' AND B.p= '$p') AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq)
 ORDER BY A.qt_no ASC, A.seq ASC, B.count DESC ";
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

<div class="content sub01">
  <div class="ct_wrap">

    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub1">
        <div class="sub_plate">
          <h3>컷팅지 상세(W - <?php echo $w; ?> / P - <?php echo $p; ?>)</h3>
          <input type="button" onclick="location.href='sub0104_print.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>'" value="인쇄하기">
          <input type="button" onclick="location.href='sub0104_excel(frame).php?w=<?php echo $w; ?>&p=<?php echo $p; ?>'" value="엑셀 다운로드">

          <div class="drawing_table">
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
                  <!-- <td>W</td> -->
                  <!-- <td>P</td> -->
                </tr>
              </thead>

              <tbody>
                <?php
                  // $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B WHERE ((B.w = '$w' OR B.w = '') AND (B.p= '$p' OR B.p ='')) AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq) ORDER BY A.qt_no ASC, A.seq ASC, B.count DESC ";
                  $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B WHERE (B.w = '$w' AND B.p= '$p') AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq)
                  ORDER BY A.qt_no ASC, A.seq ASC, B.count DESC ";
                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $i++;
                    $lap = $row['lap'];
                    $seq = $row['seq'];
                    $count = $row['count'];
                    $fr_one = $row['fr_one'];
                    $fr_two = $row['fr_two'];
                    $fr_three = $row['fr_three'];
                    $fr_four = $row['fr_four'];
                    $fr_five = $row['fr_five'];
                    // $W = $row['W'];
                    // $P = $row['P'];
                    $U = $row['U'];
                    $B = $row['B'];
                    $gak_count = $row['gak_count'];
                    $ho = $row['ho'];
                    $por = $row['por'];
                    $qt_no = $row['qt_no'];

                    $count == 0 ? $count ='' : $count;
                    $fr_one == 0 ? $fr_one = '' : $fr_one;
                    $fr_two == 0 ? $fr_two = '' : $fr_two;
                    // $fr_three == 0 ? $fr_three = '' : $fr_three;
                    // $fr_four == 0 ? $fr_four = '' : $fr_four;
                    $fr_five == 0 ? $fr_five = '' : $fr_five;
                    // $pad_one == 0 ? $pad_one = '' : $pad_one;
                    // $pad_two == 0 ? $pad_two = '' : $pad_two;
                    // $gak_count == 0 ? $gak_count = '' : $gak_count;
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
                  <!-- <td><?php echo $w; ?></td> -->
                  <!-- <td><?php echo $p; ?></td> -->
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include "../layout/footer.php"; ?>
