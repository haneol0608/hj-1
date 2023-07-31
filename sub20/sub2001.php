<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php $_SESSION['NAV'] = 'sub20'; ?>
<!-- //header -->

<?php 
    $search_str = "WHERE 1 ";

    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_paint = $_GET['search_paint'];

    if($search_ho) { $search_str .= " AND ship_no LIKE '%$search_ho%' "; }
    if($search_por) { $search_str .= " AND por_no LIKE '%$search_por%' "; }
    if($search_seq) { $search_str .= " AND seq_no LIKE '%$search_seq%' "; }
    if($search_paint) { $search_str .= " AND paint_code LIKE '%$search_paint%' "; }
?>

<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>통계적 공정정보 검색</h3>
            <form action="<?php $_SERVER['PHP_SELF'] . '?search_equip=' . $search_equip . '&search_text=' . $search_text; ?>">
                <table>
                    <tr>
                        <td>호선</td>
                        <td><input style="width: 90%;" type="text" name="search_ho" value="<?php echo $search_ho; ?>"></td>
                        <td>POR</td>
                        <td><input style="width: 90%;" type="text" name="search_por" value="<?php echo $search_por; ?>"></td>
                        <td>SEQ</td>
                        <td><input style="width: 90%;" type="text" name="search_seq" value="<?php echo $search_seq; ?>"></td>
                        <td>PAINT</td>
                        <td><input style="width: 90%;" type="text" name="search_paint" value="<?php echo $search_paint; ?>"></td>
                        <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>통계적 공정정보 조회</h3>
          <div class="code_list">
            <table>
              <thead>
                <tr>
                  <td>NO</td>
                  <td>호선</td>
                  <td>POR</td>
                  <td>SEQ</td>
                  <td>PAINT</td>
                  <td>BLOCK</td>
                  <td>PCS</td>
                  <td>LOT</td>
                  <td>생산 수량</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $i = 0;
                    $select_query = "SELECT * FROM hj_label $search_str LIMIT 20 ";
                    $select_result = mysqli_query($conn2, $select_query);
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $ship_no = $row['ship_no'];
                        $por_no = $row['por_no'];
                        $seq_no = $row['seq_no'];
                        $paint_code = $row['paint_code'];
                        $block_no = $row['block_no'];
                        $pcs_no = $row['pcs_no'];
                        $lot_no = $row['lot_no'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td><p><?php echo $ship_no; ?></p></td>
                  <td><p><?php echo $por_no; ?></p></td>
                  <td><p><?php echo $seq_no; ?></p></td>
                  <td><p><?php echo $paint_code; ?></p></td>
                  <td><p><?php echo $block_no; ?></p></td>
                  <td><p><?php echo $pcs_no; ?></p></td>
                  <td><p><?php echo $lot_no; ?></p></td>
                  <td><p><?php echo $lot_no; ?></p></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>

<?php include "../layout/footer.php"; ?>
