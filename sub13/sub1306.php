<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php 
    $enc_lotDate = $_GET['lot_date'];
    $enc_listLot = $_GET['list_lot'];

    $lot_date = base64_decode($_GET['lot_date']);
    $list_lot = base64_decode($_GET['list_lot']);

    if($lot_date == null && $list_lot == null) {
        $lot_date = null;
        $list_lot = null;
    }
?>
<div class="content sub01">
  <div class="ct_wrap">

    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub4">
        <h3>공정별 작업현황 관리</h3>
        <div class="sub_plate">
          <h3>프레임 리스트</h3>
            
          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>NO</td>
                  <td>W</td>
                  <td>P</td>
                  <td>조회</td>
                </tr>
              </thead>
    
              <tbody>
                <?php
                  $select_query = "SELECT A.w AS w, A.p AS p FROM hj_cutting AS A INNER JOIN hj_prolist AS B ON A.ho = B.ho AND A.por = B.por WHERE A.w != '' AND A.p != '' AND B.lot_date = '$lot_date' AND B.list_lot = '$list_lot' GROUP BY A.w, A.p";
                  $select_result = mysqli_query($conn, $select_query);
                  $i = 0;
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $i++;
                    $w = $row['w'];
                    $p = $row['p'];
                ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $w; ?></td>
                    <td><?php echo $p; ?></td>
                    <td>
                      <input type="button" onclick="location.href='/hj/sub01/sub0104_frame.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="프레임 상세조회">
                      <!-- <input type="button" onclick="location.href='sub0104_leg.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>'" value="다릿발 상세조회"> -->
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>

      <div class="container sub4">
        <div class="sub_plate">
          <h3>다릿발 리스트</h3>

          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>상세조회</td>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>
                    <input type="button" onclick="location.href='/hj/sub01/sub0104_leg.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="다릿발 상세조회">
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>
      </div>

    </div>
  </div>
</div>

<?php include "../layout/footer.php"; ?>
