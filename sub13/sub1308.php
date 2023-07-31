<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php 
    $search_str = " 1 ";
    $search_str2 = " ";

    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_lap = $_GET['search_lap'];
    $search_weight = $_GET['search_weight'];
    $search_series = $_GET['search_series'];
    $search_proDate1 = $_GET['search_proDate1'];
    $search_proDate2 = $_GET['search_proDate2'];
    $search_mpDate1 = $_GET['search_mpDate1'];
    $search_mpDate2 = $_GET['search_mpDate2'];
    $search_paint = $_GET['search_paint'];

    if($search_ho) {$search_str .= " AND A.ho LIKE '%$search_ho%' ";}
    if($search_por) {$search_str .= " AND A.por LIKE '%$search_por%' ";}
    if($search_seq) {$search_str .= " AND A.seq LIKE '%$search_seq%' ";}
    if($search_lap) {
        $search_str .= " AND C.lap LIKE '%$search_lap%' ";
    }
    if($search_weight) {$search_str2 .= " HAVING SUM(B.weight) = '$search_weight' ";}
    if($search_series) {$search_str .= " AND (A.series LIKE '%$search_series%') ";}
    if($search_paint) {$search_str .= " AND (C.paint LIKE '%$search_paint%') ";}
    if($search_mpDate1 && $search_mpDate2) {
        $search_str .= " AND B.mp_date BETWEEN '$search_mpDate1' AND '$search_mpDate2' ";
    } else {
        $date = date("Y-m-d");
        if($search_mpDate1) {
            $search_str .= " AND B.mp_date BETWEEN '$search_mpDate1' AND '$date' ";
        }
    }
    if($search_proDate1 && $search_proDate2) {
        $search_str .= " AND B.pro_date BETWEEN '$search_proDate1' AND '$search_proDate2' ";
    } else {
        $date = date("Y-m-d");
        if($search_proDate1) {
            $search_str .= " AND B.pro_date BETWEEN '$search_proDate1' AND '$date' ";
        }
    }
?>

<div class="content sub01">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
     
      <div class="container sub1">
        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>원자재 검색</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . "?search_ho=" . $search_ho . '&search_por=' . $search_por . '&search_seq=' . $search_seq . '&search_lap=' . $search_lap . '&search_series=' . $search_series . '&search_weight=' . $search_weight . '&search_paint=' . $search_paint . '&search_proDate1=' . $search_proDate1 . '&search_proDate2=' . $search_proDate2 . '&search_mpDate1=' . $search_mpDate1 . '&search_mpDate2=' . $search_mpDate2 . '&lot_date=' . $lot_date . '&list_lot=' . $list_lot; ?>">
                <table>
                    <tr>
                        <td>호선</td>
                        <td>
                            <input type="hidden" name='lot_date' value="<?php echo $_GET['lot_date'] ?>">
                            <input type="hidden" name='list_lot' value="<?php echo $_GET['list_lot'] ?>">
                            <input style="width: 90%;" type="text" name="search_ho" value="<?php echo $search_ho; ?>">
                        </td>
                        <td>POR</td>
                        <td><input style="width: 90%;" type="text" name="search_por" value="<?php echo $search_por; ?>"></td>
                        <td>SEQ</td>
                        <td><input style="width: 90%;" type="text" name="search_seq" value="<?php echo $search_seq; ?>"></td>
                        <td rowspan="3"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                    <tr>
                        <td>사상</td>
                        <td>
                            <!-- <input style="width: 90%;" type="text" name="search_lap" value="<?php echo $search_lap; ?>"> -->
                            <select style="width: 90%;" name="search_lap">
                                <option value="">-----------</option>
                                <option <?php if($search_lap == '3P') echo "selected"; ?> value="3P">3P</option>
                            </select>
                        </td>
                        <td>중량(kg)</td>
                        <td><input style="width: 90%;" type="text" name="search_weight" value="<?php echo $search_weight; ?>"></td>
                        <td>시리즈</td>
                        <td>
                            <input style="width: 90%;" type="text" name="search_series" value="<?php echo $search_series; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>제작납기</td>
                        <td>
                            <input style="width: 30%;" type="date" name="search_proDate1" value="<?php echo $search_proDate1; ?>"> ~ <input style="width: 30%;" type="date" name="search_proDate2" value="<?php echo $search_proDate2; ?>"><br>
                        </td>
                        <td>MP납기</td>
                        <td>
                            <input style="width: 30%;" type="date" name="search_mpDate1" value="<?php echo $search_mpDate1; ?>"> ~ <input style="width: 30%;" type="date" name="search_mpDate2" value="<?php echo $search_mpDate2; ?>"><br>
                        </td>
                        <td>PAINT</td>
                        <td>
                            <!-- <select style="width: 90%;" name="search_paint" id="">
                                <option value="">-------</option>
                                <option <?php if($search_paint == 'PM') echo "selected"; ?> value="PM">PM</option>
                                <option <?php if($search_paint == 'P1') echo "selected"; ?> value="P1">P1</option>
                                <option <?php if($search_paint == 'P2') echo "selected"; ?> value="P2">P2</option>
                                <option <?php if($search_paint == 'GP') echo "selected"; ?> value="GP">GP</option>
                                <option <?php if($search_paint == 'EV') echo "selected"; ?> value="EV">EV</option>
                                <option <?php if($search_paint == 'EK') echo "selected"; ?> value="EK">EK</option>
                                <option <?php if($search_paint == 'GP') echo "selected"; ?> value="GP">GP</option>
                                <option <?php if($search_paint == 'ZO') echo "selected"; ?> value="ZO">ZO</option>
                            </select> -->
                            <input style="width: 90%;" type="text" name="search_paint" value="<?php echo $search_paint; ?>">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>LOT별 원자재 리스트</h3>

          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td><a href="<?php echo $url . "order=qt_no&by=$by"; ?>">NO</a></td>
                  <td><a href="<?php echo $url . "order=ho&by=$by"; ?>">호선</a></td>
                  <td><a href="<?php echo $url . "order=por&by=$by"; ?>">POR</a></td>
                  <td style="width: 100px;">SEQ</td>
                  <td><a href="<?php echo $url . "order=count&by=$by"; ?>">수량</a></td>
                  <td><a href="<?php echo $url . "order=weight&by=$by"; ?>">중량</a></td>
                  <td><a href="<?php echo $url . "order=money&by=$by"; ?>">금액</a></td>
                  <td><a href="<?php echo $url . "order=pro_date&by=$by"; ?>">제작납기</a></td>
                  <td><a href="<?php echo $url . "order=mp_date&by=$by"; ?>">MP납기</a></td>
                  <td>시리즈</td>
                  <td>사상</td>
                  <td style="width: 130px;">PAINT</td>
                  <td>특수자재</td>
                  <td style="width: 30px;">개정도</td>
                  <td>NO 변경</td>
                  <!-- <td>처리</td> -->
                </tr>
              </thead>

              <tbody>
                <?php
                  $paint_arr = array();

                //**************************************공정 리스트 - LOT 번호 조회 변경**************************************//
                // 2022-12-07. 김한얼. LOT번호 추가로 조회 조건 변경
                // 2022-12-08. 김한얼. 암호화, 복호화 추가
                // 이전 코드 //
                // $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date,
                // A.series AS series, A.revision AS revision, A.sp AS sp FROM hj_prolist AS A
                // INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.qt_no = B.qt_no AND A.seq = B.seq GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp ";
                $get_lotDate = base64_decode($_GET['lot_date']);
                $get_listLot = base64_decode($_GET['list_lot']);

                $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot 
                FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.seq = B.seq INNER JOIN hj_cutting AS C ON A.ho = C.ho AND A.por = C.por AND A.seq = C.seq
                WHERE $search_str
                GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot 
                $search_str2";
                //*******************************************************************************************************//

                  if(!$order) {
                    $select_query = $select_query . "ORDER BY A.qt_no * '1' ASC, A.qt_no ASC ";
                  } else {
                    $select_query = $select_query . $order_by;
                  }

                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $ho = $row['ho'];
                    $por = $row['por'];
                    $qt_no = $row['qt_no'];
                    $count = $row['count'];
                    $weight = $row['weight'];
                    $money = $row['money'];
                    $pro_date = $row['pro_date'];
                    $mp_date = $row['mp_date'];
                    $series = $row['series'];
                    $revision = $row['revision'];
                    $sp = $row['sp'];
                ?>
                <tr>
                  <td>
                    <input class="qtNo" type="text" name="update_qtNo" value="<?php echo $qt_no; ?>">
                  </td>
                  <td>
                    <input type="hidden" name="prolist_ho[]" value="<?php echo $ho; ?>">
                    <?php echo $ho; ?>
                  </td>
                  <td>
                    <input type="hidden" name="prolist_por[]" value="<?php echo $por; ?>">
                    <?php echo $por; ?>
                  </td>
                  <td>
                  <?php
                    $select_seq_query = "SELECT seq FROM hj_prolist WHERE ho = '$ho' AND por = '$por' AND qt_no = '$qt_no' GROUP BY seq ORDER BY seq ASC";
                    $select_seq_result = mysqli_query($conn, $select_seq_query);
                    while($seq_row = mysqli_fetch_assoc($select_seq_result)) {
                      $seq = $seq_row['seq'];
                      echo "<input type='hidden' name='prolist_seq[]' value='$seq'> ";
                      $seq = $seq . ", ";
                      echo $seq < 10 ? "0" . $seq : $seq;
                    }
                  ?>
                  </td>
                  <td><?php echo number_format($count); ?></td>
                  <td><?php echo $weight; ?></td>
                  <td><?php echo number_format($money); ?></td>
                  <td>
                    <input type="date" name="input_pro_date[]" value="<?php echo $pro_date; ?>">
                  </td>
                  <td>
                    <input type="date" name="input_mp_date[]" value="<?php echo $mp_date; ?>">
                  </td>
                  <td>
                    <input style="width: 50px;" type="text" name="input_series[]" value="<?php echo $series; ?>">
                  </td>
                  <td>
                    <?php
                      $select_lap_query = "SELECT COUNT(A.lap) AS count_lap FROM hj_cutting AS A RIGHT JOIN hj_prolist AS B ON A.por = B.por AND A.ho = B.ho AND A.seq = B.seq WHERE A.ho = '$ho' AND A.por = '$por' "; 
                      $select_lap_query .= "AND B.qt_no = '$qt_no' AND A.paint != '' AND A.lap !='' ";
                      $select_lap_result = mysqli_query($conn, $select_lap_query);
                      $lap_row = mysqli_fetch_assoc($select_lap_result);
                      $count_lap = $lap_row['count_lap'];

                      if($count_lap == 0) {
                        echo "";
                      } else if($count == $count_lap or $count < $count_lap) {
                        echo "3P";
                      } else if($count > $count_lap) {
                        echo "3P";
                      }
                    ?>
                  </td>
                  <td>
                    <?php
                      $select_paint_query = "SELECT A.paint AS paint, COUNT(A.paint) AS count_paint FROM hj_cutting AS A RIGHT JOIN hj_prolist AS B ON A.por = B.por AND A.ho = B.ho AND A.seq = B.seq
                      WHERE A.ho = '$ho' AND A.por = '$por' AND A.paint != '' AND B.qt_no = '$qt_no' GROUP BY A.ho, A.por, A.paint, B.qt_no ";
                      $select_paint_result = mysqli_query($conn, $select_paint_query);
                      while($paint_row = mysqli_fetch_assoc($select_paint_result)) {
                        $paint = $paint_row['paint'];
                        $count_paint = $paint_row['count_paint'];

                        echo $paint . " : " . $count_paint . "<br>";
                      }
                    ?>
                  </td>
                  <td>
                    <textarea name="input_sp[]" rows="2" cols="20"><?php echo $sp; ?></textarea>
                  </td>
                  <td>
                    <!-- <input style="width: 50px;" type="text" name="input_revision[]" value="<?php echo $revision; ?>"> -->
                    <?php 
                        $select_revision_query = "SELECT revision FROM hj_draw WHERE ho = '$ho' AND por = '$por' ";
                        $select_revision_result = mysqli_query($conn, $select_revision_query);
                        $revision_row = mysqli_fetch_assoc($select_revision_result);
                        $revision = $revision_row['revision'];
                        if($revision == null or $revision == "") {
                            echo "";
                        } else if($revision == 0) {
                            echo "0";
                        } else if($revision < 10) {
                            echo "00" . $revision;
                        } else if($revision > 10 AND $revision < 100) {
                            echo "0" . $revision;
                        }
                    ?>
                  </td>
                  <td>
                    <input type="button" name="add_prolist" onclick="add_prolist(this);" value="변경">
                  </td>
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
