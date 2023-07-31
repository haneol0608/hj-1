<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

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
    $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B WHERE (A.lot_date = '$lot_date' AND A.list_lot = '$list_lot') AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq) ORDER BY A.qt_no * '1' ASC, A.qt_no ASC, A.seq ASC, B.count DESC ";
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

<?php 
    $search_str = " WHERE 1";
    
    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_lap = $_GET['search_lap'];
    $search_frleg = $_GET['search_frleg'];
    $search_frlegVal = $_GET['search_frlegVal'];
    $search_pad = $_GET['search_pad'];
    $search_paint = $_GET['search_paint'];

    if($search_ho) {$search_str .= " AND A.ho LIKE '%$search_ho%' ";}
    if($search_por) {$search_str .= " AND A.por LIKE '%$search_por%' ";}
    if($search_seq) {$search_str .= " AND A.seq LIKE '%$search_seq%' ";}
    if($search_lap) {$search_str .= " AND A.lap LIKE '%$search_lap%' ";}
    if($search_pad) {$search_str .= " AND (B.pad_one LIKE '%$search_pad%' or B.pad_two LIKE '%$search_pad%') ";}
    if($search_paint) {$search_str .= " AND B.paint LIKE '%$search_paint%' ";}

    if($search_frleg == 'leg1') {
        $search_str .= " AND (leg1_one LIKE '%$search_frlegVal%' or leg1_one LIKE '%$search_frlegVal%' or leg1_three LIKE '%$search_frlegVal%' or leg1_four LIKE '%$search_frlegVal%' or leg1_five LIKE '%$search_frlegVal%') ";
    } else if($search_frleg == 'leg2') {
        $search_str .= " AND (leg2_one = '$search_frlegVal' or leg2_one = '$search_frlegVal' or leg2_three = '$search_frlegVal' or leg2_four = '$search_frlegVal' or leg2_five = '$search_frlegVal') ";
    }
?>

<div class="content sub01">
  <div class="ct_wrap">

    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub1">
         <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>다릿발 검색</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . "?search_ho=" . $search_ho . '&search_por=' . $search_por . '&search_seq=' . $search_seq . '&search_lap=' . $search_lap . '&search_weight=' . $search_weight . '&search_frleg=' . $search_frleg . '&search_frlegVal=' . $search_frlegVal . '&search_pad=' . $search_pad . '&search_wpub=' . $search_wpub . '&search_wpubVal=' . $search_wpubVal . '&search_paint=' . $search_paint . '&list_lot=' . $list_lot . '&lot_date=' . $lot_date . '&w=' . $w . '&p=' . $p;; ?>">
                <table>
                    <tr>
                        <td>호선</td>
                        <td>
                            <input type="hidden" name="lot_date" value="<?php echo $_GET['lot_date']; ?>">
                            <input type="hidden" name="list_lot" value="<?php echo $_GET['list_lot']; ?>">
                            <input type="hidden" name="w" value="<?php echo $_GET['w']; ?>">
                            <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>">
                            <input style="width: 90%;" type="text" name="search_ho" value="<?php echo $search_ho; ?>">
                        </td>
                        <td>POR</td>
                        <td><input style="width: 90%;" type="text" name="search_por" value="<?php echo $search_por; ?>"></td>
                        <td>SEQ</td>
                        <td><input style="width: 90%;" type="text" name="search_seq" value="<?php echo $search_seq; ?>"></td>
                        <td rowspan="3"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                    <tr>
                        <td>LEG</td>
                        <td>
                            <select name="search_frleg" id="">
                                <option value="">--------</option>
                                <option <?php if($search_frleg == 'leg1') echo "selected"; ?> value="leg1">LEG 65*9T</option>
                                <option <?php if($search_frleg == 'leg2') echo "selected"; ?> value="leg2">LEG 65*65*8T</option>
                            </select>
                            <input style="width: 67%;" type="text" name="search_frlegVal" value="<?php echo $search_frlegVal; ?>">
                        </td>
                        <td>PAD 수치</td>
                        <td>
                            <input style="width: 90%;" type="text" name="search_pad" value="<?php echo $search_pad; ?>">
                        </td>
                        <td>PAINT</td>
                        <td>
                            <input style="width: 90%;" type="text" name="search_paint" value="<?php echo $search_paint; ?>">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>컷팅지 상세</h3>
          <input type="button" onclick="location.href='sub0104_print2.php?lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'; logData(this, '다릿발 배포', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="인쇄하기">
          <input type="button" onclick="location.href='sub0104_excel(leg).php?lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="엑셀 출력하기">
          <input type="button" onclick="label_wait();" value="라벨 마킹대기">
          <input type="button" onclick="location.href='/hj/sub01/sub0104.php?lot_date=<?php echo $_GET['lot_date']; ?>&list_lot=<?php echo $_GET['list_lot']; ?>'" value="이전 리스트">

          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>
                    <input id="all_check" type="checkbox" onclick="on_chk();">
                  </td>
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
                  $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B $search_str AND (A.lot_date = '$lot_date' AND A.list_lot = '$list_lot') AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq) ORDER BY  A.qt_no * '1' ASC, A.qt_no ASC, A.seq ASC, B.count DESC";
                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
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
                  <td>
                    <input class="sub_check" type="checkbox" name="label_seq[]" value="<?php echo $seq; ?>">
                  </td>
                  <td><?php echo $seq; ?></td>
                  <td><?php echo $count; ?></td>
                  <td><?php echo htmlspecialchars($leg1_one); ?></td>
                  <td><?php echo htmlspecialchars(nl2br($leg1_two)); ?></td>
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
                  <td>
                    <input type="hidden" name="label_paint[]" value="<?php echo $paint; ?>">
                    <?php echo htmlspecialchars($paint); ?>
                  </td>
                  <td>
                    <input type="hidden" name="label_ho[]" value="<?php echo $ho; ?>">
                    <?php echo $ho; ?>
                  </td>
                  <td>
                    <input type="hidden" name="label_por[]" value="<?php echo $por; ?>">
                    <?php echo $por; ?>
                  </td>
                  <td><?php echo $qt_no; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <?php //} ?>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>


<?php include "../layout/footer.php"; ?>
