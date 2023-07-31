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

<div class="content sub01">
  <div class="ct_wrap">
    <div class="container_ct">
     
      <div class="container sub1">
        <div class="sub_plate">
          <h3>공정리스트 조회</h3>
          <?php
            //**************************************공정 리스트 - LOT 번호 조회 변경**************************************//
            // 2022-12-08. 김한얼. 암호화 LOT 번호 -> 암호화 GET 선언
            $get_lotDate = $_GET['lot_date'];
            $get_listLot = $_GET['list_lot'];
            
            $order = $_GET['order'];
            
            // 2022-12-08. 김한얼. 암호화 LOT 번호 -> 검색 기능 반영
            // 이전 코드 //
            // $url = $_SERVER['PHP_SELF'] . "?";

            if($get_lotDate !== null && $get_listLot !== null) {
                $url = $_SERVER['PHP_SELF'] . "?lot_date=$get_lotDate&list_lot=$get_listLot&";
            } else {
                $url = $_SERVER['PHP_SELF'] . "?";
            }
            //*******************************************************************************************************//

            $by = $_GET['by'];

            if ($by == "" || $by == "DESC") {
                $order_by = "ORDER BY " . $order . " DESC";
                $by = "ASC";
            } else if ($by == "ASC") {
                $order_by = "ORDER BY " . $order . " ASC";
                $by = "DESC";
            }

            //**************************************공정 리스트 - 문자열 정렬 / 역정렬**************************************//
            // 2022-12-13. 김한얼. 문자형 -> 숫자 처럼 정렬 / 역정렬
            if($order == "qt_no") {
                if($by == "ASC") {
                  $order_by = "ORDER BY A.qt_no * 1 ASC, A.qt_no ASC";
                } else if($by == "DESC") {
                  $order_by = "ORDER BY A.qt_no * 1 DESC, A.qt_no ASC";
                }
              }
              //*******************************************************************************************************//
          ?>
          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>NO</td>
                  <td>호선</td>
                  <td>POR</td>
                  <td style="width: 90px;">SEQ</td>
                  <td>수량</td>
                  <td>중량</td>
                  <td>금액</td>
                  <td>제작납기</td>
                  <td>MP납기</td>
                  <td style="width: 50px;">시리즈</td>
                  <td style="width: 60px;">사상</td>
                  <td style="width: 90px;">PAINT</td>
                  <td>특수자재</td>
                  <td style="width: 50px;">개정도</td>
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

                  if($get_lotDate != null && $get_listLot != null) {
                    // 이전 코드//
                    // $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot 
                    // FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.qt_no = B.qt_no AND A.seq = B.seq 
                    // WHERE lot_date = '$get_lotDate' AND list_lot = '$get_listLot' 
                    // GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot ";

                    $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot 
                    FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.seq = B.seq 
                    WHERE lot_date = '$get_lotDate' AND list_lot = '$get_listLot' 
                    GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot ";
                  } else {
                    $select_query = "SELECT A.ho AS ho, A.por AS por, A.qt_no AS qt_no, SUM(B.count) AS count, SUM(B.weight) AS weight, SUM(money) AS money, MIN(B.pro_date) AS pro_date, MIN(B.mp_date) AS mp_date, A.series AS series, A.revision AS revision, A.sp AS sp, A.lot_date, A.list_lot 
                    FROM hj_prolist AS A INNER JOIN hj_quantity AS B ON A.ho = B.ho AND A.por = B.por AND A.qt_no = B.qt_no AND A.seq = B.seq 
                    WHERE lot_date IS NULL AND list_lot IS NULL 
                    GROUP BY A.ho, A.por, A.qt_no, A.series, A.revision, A.sp, A.lot_date, A.list_lot ";
                  }
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
                  <td><?php echo $qt_no; ?></td>
                  <td><?php echo $ho; ?></td>
                  <td><?php echo $por; ?></td>
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
                  <td><?php echo $pro_date; ?></td>
                  <td><?php echo $mp_date; ?></td>
                  <td><?php echo $series; ?></td>
                  <td>
                    <?php
                      $select_lap_query = "SELECT COUNT(A.lap) AS count_lap FROM hj_cutting AS A RIGHT JOIN hj_prolist AS B ON A.por = B.por AND A.ho = B.ho AND A.seq = B.seq WHERE A.ho = '$ho' AND A.por = '$por' "; 
                      $select_lap_query .= "AND B.qt_no = '$qt_no' AND A.paint != '' AND A.lap !='' ";
                      $select_lap_result = mysqli_query($conn, $select_lap_query);
                      $lap_row = mysqli_fetch_assoc($select_lap_result);
                      $count_lap = $lap_row['count_lap'];

                      if($count_lap == 0) {
                        echo "";
                      } else if($count == $count_lap) {
                        echo "3P";
                      } else if($count > $count_lap) {
                        echo "일부 3P";
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
                  <td><?php echo nl2br($sp); ?></td>
                  <td>
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