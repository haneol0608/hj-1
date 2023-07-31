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
    $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B WHERE (A.lot_date = '$lot_date' AND A.list_lot = '$list_lot') AND (B.w = '$w' AND B.p= '$p') AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq) ORDER BY A.qt_no * '1' ASC, A.qt_no ASC, A.seq ASC, B.count DESC ";
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
        $value = (int)$value & 1 ? '#DCDCDC' : 'white';
    }
    // ******************************************************************************************************************************************************//
?>

<?php 
    $search_str = " WHERE 1";
    
    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_weight = $_GET['search_weight'];
    $search_frleg = $_GET['search_frleg'];
    $search_frlegVal = $_GET['search_frlegVal'];
    $search_pad = $_GET['search_pad'];
    $search_wpub = $_GET['search_wpub'];
    $search_wpubVal = $_GET['search_wpubVal'];
    $search_lap = $_GET['search_lap'];

    if($search_ho) {$search_str .= " AND A.ho LIKE '%$search_ho%' ";}
    if($search_por) {$search_str .= " AND A.por LIKE '%$search_por%' ";}
    if($search_seq) {$search_str .= " AND A.seq LIKE '%$search_seq%' ";}
    if($search_wpub) {$search_str .= " AND B.$search_wpub LIKE '%$search_wpubVal%' ";}
    if($search_lap) { $search_str .= " AND B.lap LIKE '%$search_lap%' "; }

    if($search_frleg == 'fr') {
        $search_str .= " AND (fr_one = '$search_frlegVal' or fr_one = '$search_frlegVal' or fr_three = '$search_frlegVal' or fr_four = '$search_frlegVal' or fr_five = '$search_frlegVal') ";
    }
?>

<div class="content sub01">
  <div class="ct_wrap">

    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub1">

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>프레임 검색</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . "?search_ho=" . $search_ho . '&search_por=' . $search_por . '&search_seq=' . $search_seq . '&search_lap=' . $search_lap . '&search_weight=' . $search_weight . '&search_frleg=' . $search_frleg . '&search_frlegVal=' . $search_frlegVal . '&search_pad=' . $search_pad . '&search_wpub=' . $search_wpub . '&search_wpubVal=' . $search_wpubVal . '&search_paint=' . $search_paint . '&list_lot=' . $list_lot . '&lot_date=' . $lot_date . '&w=' . $w . '&p=' . $p; ?>">
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
                        <td>FRAME</td>
                        <td>
                            <select name="search_frleg" id="">
                                <option <?php if($search_frleg == 'fr') echo "selected"; ?> value="fr">FRAME 65*9T</option>
                            </select>
                            <input style="width: 67%;" type="text" name="search_frlegVal" value="<?php echo $search_frlegVal; ?>">
                        </td>
                        <td>U/B 수치</td>
                        <td>
                            <select name="search_wpub" id="">
                                <option value="">---------</option>
                                <option <?php if($search_wpub == 'u') echo "selected"; ?> value="u">U 수치</option>
                                <option <?php if($search_wpub == 'B') echo "selected"; ?> value="b">B 수치</option>
                            </select>
                            <input style="width: 67%;" type="text" name="search_wpubVal" value="<?php echo $search_wpubVal; ?>">
                        </td>
                        <td>사상</td>
                        <td>
                            <select style="width: 90%;" name="search_lap">
                                <option value="">-----------</option>
                                <option <?php if($search_lap == '3P') echo "selected" ?> value="3P">3P</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>컷팅지 상세(W - <?php echo $w; ?> / P - <?php echo $p; ?>)</h3>
          <input type="button" onclick="location.href='sub0104_print.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="인쇄하기">
          <input type="button" onclick="location.href='sub0104_excel(frame).php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="엑셀 다운로드">
          <input type="button" onclick="label_wait();" value="라벨 마킹대기">
          <input type="button" onclick="location.href='/hj/sub01/sub0104.php?lot_date=<?php echo $_GET['lot_date']; ?>&list_lot=<?php echo $_GET['list_lot']; ?>'" value="이전 리스트">

          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>
                    <input id="all_check" type="checkbox" onclick="on_chk();">
                  </td>
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
                  $select_query = "SELECT * FROM hj_prolist AS A, hj_cutting AS B $search_str AND (A.lot_date = '$lot_date' AND A.list_lot = '$list_lot') AND (B.w = '$w' AND B.p= '$p') AND (A.ho = B.ho AND A.por = B.por AND A.seq = B.seq)
                  ORDER BY A.qt_no * '1' ASC, A.qt_no ASC, A.seq ASC, B.count DESC ";

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
                    $paint = $row['paint'];
                    
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
                  <td>
                    <input class="sub_check" type="checkbox" name="label_seq[]" value="<?php echo $seq; ?>">
                    <input type="hidden" name="label_paint[]" value="<?php echo $paint; ?>">
                  </td>
                  <td><?php echo $lap; ?></td>
                  <td>
                    <?php echo $seq; ?>
                  </td>
                  <td><?php echo $count; ?></td>
                  <td><?php echo htmlspecialchars($fr_one); ?></td>
                  <td><?php echo htmlspecialchars($fr_two); ?></td>
                  <td><?php echo htmlspecialchars($fr_three); ?></td>
                  <td><?php echo htmlspecialchars($fr_four); ?></td>
                  <td><?php echo htmlspecialchars($fr_five); ?></td>
                  <td><?php echo htmlspecialchars($U); ?></td>
                  <td><?php echo htmlspecialchars($B); ?></td>
                  <td><?php echo htmlspecialchars($gak_count); ?></td>
                  <td>
                    <input type="hidden" name="label_ho[]" value="<?php echo $ho; ?>">
                    <?php echo $ho; ?>
                  </td>
                  <td>
                    <input type="hidden" name="label_por[]" value="<?php echo $por; ?>">
                    <?php echo $por; ?>
                  </td>
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
