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
      <div class="container sub0204">
        <div class="sub_plate">

          <div class="flex">
            <h3>W, P 리스트</h3>
            <input type="button" onclick="history.back();" value="뒤로가기">
          </div>
            
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
                  $select_query = "SELECT w, p FROM hj_lada WHERE w != '' AND p != '' AND lot_date = '$lot_date' AND list_lot = '$list_lot' GROUP BY w, p";
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
                      <input type="button" onclick="location.href='sub0204_frame.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="프레임 상세조회">
                      <!-- <input type="button" onclick="location.href='sub0104_leg.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>'" value="다릿발 상세조회"> -->
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>

      <div class="container sub0204">
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
                    <input type="button" onclick="location.href='sub0204_leg.php?w=<?php echo $w; ?>&p=<?php echo $p; ?>&lot_date=<?php echo $enc_lotDate; ?>&list_lot=<?php echo $enc_listLot; ?>'" value="다릿발 상세조회">
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
