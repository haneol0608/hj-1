<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub12'; ?>

<?php
    $por_no = $_GET['por_no'];
    $ho = substr($por_no, 0, 4);
    $por = substr($por_no, 4, 6);

    $search_str = "  ";

    $search_seq = $_GET['search_seq'];
    $search_lap = $_GET['search_lap'];
    $search_weight = $_GET['search_weight'];
    $search_frleg = $_GET['search_frleg'];
    $search_frlegVal = $_GET['search_frlegVal'];
    $search_pad = $_GET['search_pad'];
    $search_wpub = $_GET['search_wpub'];
    $search_wpubVal = $_GET['search_wpubVal'];
    $search_paint = $_GET['search_paint'];

    if($search_ho) {$search_str .= " AND ho LIKE '%$search_ho%' ";}
    if($search_por) {$search_str .= " AND por LIKE '%$search_por%' ";}
    if($search_seq) {$search_str .= " AND seq LIKE '%$search_seq%' ";}
    if($search_lap) {$search_str .= " AND lap LIKE '%$search_lap%' ";}
    if($search_weight) {$search_str .= " AND weight LIKE '%$search_weight%' ";}
    if($search_pad) {$search_str .= " AND (pad_one LIKE '%$search_pad%' or pad_two LIKE '%$search_pad%') ";}
    if($search_wpub) {$search_str .= " AND $search_wpub LIKE '%$search_wpubVal%' ";}
    if($search_paint) {$search_str .= " AND paint = '$search_paint' ";}

    if($search_frleg == 'fr') {
        $search_str .= " AND (fr_one = '$search_frlegVal' or fr_one = '$search_frlegVal' or fr_three = '$search_frlegVal' or fr_four = '$search_frlegVal' or fr_five = '$search_frlegVal') ";
    } else if($search_frleg == 'leg1') {
        $search_str .= " AND (leg1_one = '$search_frlegVal' or leg1_one = '$search_frlegVal' or leg1_three = '$search_frlegVal' or leg1_four = '$search_frlegVal' or leg1_five = '$search_frlegVal') ";
    } else if($search_frleg == 'leg2') {
        $search_str .= " AND (leg2_one = '$search_frlegVal' or leg2_one = '$search_frlegVal' or leg2_three = '$search_frlegVal' or leg2_four = '$search_frlegVal' or leg2_five = '$search_frlegVal') ";
    }
?>

<div class="content sub01">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub01">
        <div style="margin-bottom:10px">
            <input type="button" value="뒤로가기" onclick="location.href='sub1201.php';">
        </div>
        <div class="sub_plate">
          <h3>POR 번호</h3>

          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>호선</td>
                  <td>POR</td>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td><?php echo $ho; ?></td>
                  <td><?php echo $por; ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>생산계획정보 검색</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . "?por_no=" . $por_no . '&search_seq=' . $search_seq . '&search_lap=' . $search_lap . '&search_weight=' . $search_weight . '&search_frleg=' . $search_frleg . '&search_frlegVal=' . $search_frlegVal . '&search_pad=' . $search_pad . '&search_wpub=' . $search_wpub . '&search_wpubVal=' . $search_wpubVal . '&search_paint=' . $search_paint; ?>">
                <table>
                    <tr>
                        <td>사상</td>
                        <td>
                            <input type="hidden" name="por_no" value="<?php echo $por_no; ?>">
                            <input style="width: 90%;" type="text" name="search_lap" value="<?php echo $search_lap; ?>">
                        </td>
                        <td>중량(kg)</td>
                        <td><input style="width: 90%;" type="text" name="search_weight" value="<?php echo $search_weight; ?>"></td>
                        <td>SEQ</td>
                        <td><input style="width: 90%;" type="text" name="search_seq" value="<?php echo $search_seq; ?>"></td>
                        <td rowspan="3"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                    <tr>
                        <td>FRAME/LEG</td>
                        <td>
                            <select name="search_frleg" id="">
                                <option value="">--------</option>
                                <option <?php if($search_frleg == 'fr') echo "selected"; ?> value="fr">FRAME 65*9T</option>
                                <option <?php if($search_frleg == 'leg1') echo "selected"; ?> value="leg1">LEG 65*9T</option>
                                <option <?php if($search_frleg == 'leg2') echo "selected"; ?> value="leg2">LEG 65*65*8T</option>
                            </select>
                            <input style="width: 67%;" type="text" name="search_frlegVal" value="<?php echo $search_frlegVal; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>PAD 수치</td>
                        <td>
                            <input style="width: 90%;" type="text" name="search_pad" value="<?php echo $search_pad; ?>">
                        </td>
                        <td>W/P/U/B 수치</td>
                        <td>
                            <select name="search_wpub" id="">
                                <option value="">---------</option>
                                <option <?php if($search_wpub == 'w') echo "selected"; ?> value="w">W 수치</option>
                                <option <?php if($search_wpub == 'p') echo "selected"; ?> value="p">P 수치</option>
                                <option <?php if($search_wpub == 'u') echo "selected"; ?> value="u">U 수치</option>
                                <option <?php if($search_wpub == 'B') echo "selected"; ?> value="b">B 수치</option>
                            </select>
                            <input style="width: 67%;" type="text" name="search_wpubVal" value="<?php echo $search_wpubVal; ?>">
                        </td>
                        <td>PAINT</td>
                        <td>
                            <select style="width: 90%;" name="search_paint" id="">
                                <option value="">-------</option>
                                <?php 
                                    $select_paint_query = "SELECT paint FROM hj_cutting WHERE por = '$por' AND ho = '$ho' AND paint != '' GROUP BY paint ";
                                    $select_paint_result = mysqli_query($conn, $select_paint_query);
                                    while($paint_row = mysqli_fetch_assoc($select_paint_result)) {
                                        $paint = $paint_row['paint'];
                                ?>
                                <option <?php if($search_paint == $paint) echo "selected"; ?> value="<?php echo $paint; ?>"><?php echo $paint; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>원자재 관리</h3>
            <?php
              $select_show_query = "SELECT * FROM hj_cutting WHERE por = '$por' AND ho = '$ho' ";
              $select_show_result = mysqli_query($conn, $select_show_query);
              $show_row = mysqli_fetch_assoc($select_show_result);
              $show_por = $show_row['por'];
              $show_ho = $show_row['ho'];

              $select_query = "SELECT MAX(qt_no * 1) AS MAX_qt_no FROM hj_quantity WHERE quantity_ok IS NULL AND qt_no != '긴급' ";
              $select_result = mysqli_query($conn, $select_query);
              $row = mysqli_fetch_assoc($select_result);
              $MAX_qt_no = $row['MAX_qt_no'];
              
              if($MAX_qt_no === null) {
                $MAX_qt_no = 1;
              } else if($MAX_qt_no !== null) {
                $MAX_qt_no = $MAX_qt_no;
              }
            ?>
          <div>
            <input type="hidden" name="MAX_qt_no" value="<?php echo $MAX_qt_no; ?>">
            (현재 마지막 물량 번호 : <?php echo $MAX_qt_no; ?>)
          </div>
          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                    <td>SEQ</td>
                    <td>사상</td>
                    <td>수량</td>
                    <td>중량</td>
                    <td colspan="5">F . B<br>(FRAME)65*9T</td>
                    <td colspan="5">F . B<br>(LEG)65*9T</td>
                    <td colspan="5">E . A<br>(LEG)65*65*8T</td>
                    <td>PAD<br>100</td>
                    <td>PAD<br>130</td>
                    <td>W</td>
                    <td>P</td>
                    <td>U</td>
                    <td>B</td>
                    <td>PAINT</td>
                    <td>각철<br>수량</td>
                    <td>R.B<br>Ø22</td>
                    <td>R.B<br>Ø25</td>
                    <td>HOOP<br>50*9T</td>
                    <td>HOOP<br>Ø19</td>
                </tr>
              </thead>

              <tbody>
                <?php
                //   $select_query = "SELECT * FROM hj_cutting WHERE por = '$por' AND ho = '$ho' $search_str ORDER BY no ASC ";
                  $select_query = "SELECT * FROM hj_lada WHERE por = '$por' AND ho = '$ho' AND (hide_name IS NULL AND hide_date IS NULL) $search_str ORDER BY no ASC ";
                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $no = $row['no'];
                    $seq = $row['seq'];
                    $lap = $row['lap'];
                    $count = $row['count'];
                    $weight = $row['weight'];
                    $fr_one = $row['fr_one'];
                    $fr_two = $row['fr_two'];
                    $fr_three = $row['fr_three'];
                    $fr_four = $row['fr_four'];
                    $fr_five = $row['fr_five'];
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
                    $W = $row['W'];
                    $P = $row['P'];
                    $U = $row['U'];
                    $B = $row['B'];
                    $paint = $row['paint'];
                    $gak_count = $row['gak_count'];
                    $RB22 = $row['RB22'];
                    $RB25 = $row['RB25'];
                    $hoop1 = $row['hoop1'];
                    $hoop2 = $row['hoop2'];

                    // 2. 0을 빈 값으로 삼항연산자 치환
                    // $weight == 0 ? $weight = '' : $weight;
                    // $pad_one == 0 ? $pad_one = '' : $pad_one;
                    // $RB22 == 0 ? $RB22 = '' : $RB22;
                    // $RB25 == 0 ? $RB25 = '' : $RB25;
                    $hoop1 == 0 ? $hoop1 = '' : $hoop1;
                    $hoop2 == 0 ? $hoop2 = '' : $hoop2;
                    $count == 0 ? $count = '' : $count;
                    $weight == 0 ? $weight = '' : $weight;
                    $fr_one == 0 ? $fr_one = '' : $fr_one;
                    $fr_five == 0 ? $fr_five = '' : $fr_five;
                    $leg2_one == 0 ? $leg2_one = '' : $leg2_one;
                    $leg2_five == 0 ? $leg2_five = '' : $leg2_five;
                    // $pad_two == 0 ? $pad_two = '' : $pad_two;-
                    // $W == 0 ? $W = '' : $W;
                    // $P == 0 ? $P = '' : $P;-
                    // $U == 0 ? $U = '' : $U;
                    // $B == 0 ? $B = '' : $B;-
                    // $gak_count == 0 ? $gak_count = '' : $gak_count;
                    $leg1_one == 0 ? $leg1_one = '' : $leg1_one;
                    $leg1_five == 0 ? $leg1_five = '' : $leg1_five;
                ?>
                <?php 
                    //*********************** 2023-03-28. 김한얼 팀장. 라벨 마킹기 생산완료 매칭 표시 ***********************//
                    $select_query2 = "SELECT ship_no, por_no, seq_no, COUNT(ship_no) AS count FROM hj_label WHERE (ship_no = '$ho' AND por_no = '$por' AND seq_no = '$seq')  GROUP BY ship_no, por_no, seq_no";
                    // echo $select_query2 . "<br>";
                    $select_result2 = mysqli_query($conn2, $select_query2);
                    $row2 = mysqli_fetch_assoc($select_result2);

                    $ship_no = $row2['ship_no'];
                    $por_no = $row2['por_no'];
                    $seq_no = $row2['seq_no'];

                    if($ship_no && $por_no && $seq_no ) {
                ?>
                <tr style="background-color: #DCDCDC;">
                <?php 
                    } 
                    //***************************************************************************************************+ */
                ?>
                  <td><?php echo htmlspecialchars($seq); ?></td>
                  <td><?php echo htmlspecialchars($lap); ?></td>
                  <td><?php echo htmlspecialchars($count); ?></td>
                  <td>
                    <?php echo htmlspecialchars($weight); ?>
                    <!-- <?php if($count !== '') { ?>
                    <input type="hidden" name="no_in[]" value="<?php echo $no; ?>">
                    <input type="text" name="weight_in[]" value="<?php echo $weight; ?>" placeholder="중량을 입력해주세요.">
                    <?php } ?> -->
                  </td>
                  <td><?php echo htmlspecialchars($fr_one); ?></td>
                  <td><?php echo htmlspecialchars($fr_two); ?></td>
                  <td><?php echo htmlspecialchars($fr_three); ?></td>
                  <td><?php echo htmlspecialchars($fr_four); ?></td>
                  <td><?php echo htmlspecialchars($fr_five); ?></td>
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
                  <td><?php echo htmlspecialchars($W); ?></td>
                  <td><?php echo htmlspecialchars($P); ?></td>
                  <td><?php echo htmlspecialchars($U); ?></td>
                  <td><?php echo htmlspecialchars($B); ?></td>
                  <td><?php echo htmlspecialchars($paint); ?></td>
                  <td><?php echo htmlspecialchars($gak_count); ?></td>
                  <td><?php echo htmlspecialchars($RB22); ?></td>
                  <td><?php echo htmlspecialchars($RB25); ?></td>
                  <td><?php echo htmlspecialchars($hoop1); ?></td>
                  <td><?php echo htmlspecialchars($hoop2); ?></td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>


    </div>
  </div>
</div>


<?php include "../layout/footer.php"; ?>
