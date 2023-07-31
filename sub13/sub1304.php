<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub13'; ?>
<?php $_SESSION['page'] = 'sub1304'; ?>

<div class="content sub01">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">

      <div class="container sub1">
        <div class="sub_plate">
          <h3>작업지시 관리</h3>
          <input type="button" onclick="quantity_delete2();" value="선택물량 취소">
          <input type="button" onclick="other_update3();" value="전체 저장">
          <input type="button" onclick="input_prolist2(); logData(this, '공정리스트 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="공정 리스트 등록">

          <div>
            <select name="emg_list_title">
                <?php 
                    $select_prolist_query = "SELECT list_title, lot_date, list_lot FROM hj_lada WHERE list_title IS NOT NULL GROUP BY list_title, lot_date, list_lot ORDER BY lot_date DESC";
                    $select_prolist_result = mysqli_query($conn, $select_prolist_query);
                    while($prolist_row = mysqli_fetch_assoc($select_prolist_result)) {
                        $list_title = $prolist_row['list_title'];
                        $lot_date = $prolist_row['lot_date'];
                        $list_lot = $prolist_row['list_lot'];
                ?>
                <option value="<?php echo $list_title; ?>"><?php echo $list_title; ?></option>
                <?php } ?>
            </select>
            <input type="button" onclick="emg_prolist2(); logData(this, '긴급 공정리스트 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="긴급 공정리스트 추가">
          </div>

          <div class="drawing_table">
            <table>
              <thead>
                <tr>
                  <td>
                    <input id="all_check" type="checkbox" onclick="on_chk();">
                  </td>
                  <td>NO</td>
                  <td colspan="2">POR 번호</td>
                  <td>SEQ</td>
                  <td>계약량</td>
                  <td>총중량</td>
                  <td>계약금액</td>
                  <td>품명/재질/규격</td>
                  <td>제작납기</td>
                  <td>MP납기</td>
                </tr>
              </thead>

              <tbody>
                <?php
                //   $select_query = "SELECT A.no AS no, A.qt_no AS qt_no, A.ho AS ho, A.por AS por, A.seq AS seq, A.count AS count, A.weight AS weight, A.money AS money, A.other AS other, A.pro_date AS pro_date, A.mp_date AS mp_date
                //   FROM hj_quantity AS A LEFT JOIN hj_prolist AS B ON A.ho = B.ho AND A.por = B.por AND A.seq = B.seq WHERE B.ho IS NULL AND B.por IS NULL AND B.seq IS NULL AND A.quantity_ok IS NULL ORDER BY A.qt_no * '+1' ASC, A.qt_no ASC, A.seq * '+1' ";
                  $select_query = "SELECT * FROM hj_lada WHERE qt_no IS NOT NULL AND count != 0 AND quantity_ok IS NULL ORDER BY qt_no * '+1' ASC, qt_no ASC, seq * '+1' ";

                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $no = $row['no'];
                    $qt_no = $row['qt_no'];
                    $ho = $row['ho'];
                    $por = $row['por'];
                    $seq = $row['seq'];
                    $count = $row['count'];
                    $weight = $row['weight'];
                    $money = $row['money'];
                    $ohter = $row['other'];
                    $pro_date = $row['pro_date'];
                    $mp_date = $row['mp_date'];
                ?>
                <tr>
                  <td>
                    <input class="sub_check" type="checkbox" name="quantity_no[]" value="<?php echo $no; ?>">
                    <input type="hidden" name="input_qt_no[]" value="<?php echo $qt_no; ?>">
                  </td>
                  <td>
                    <input type="hidden" name="no[]" value="<?php echo $no; ?>">
                    <?php echo $qt_no; ?>
                  </td>
                  <td>
                    <input type="hidden" name="input_ho[]" value="<?php echo $ho; ?>">
                    <?php echo $ho; ?>
                  </td>
                  <td>
                    <input type="hidden" name="input_por[]" value="<?php echo $por; ?>">
                    <?php echo $por; ?>
                  </td>
                  <td>
                    <input type="hidden" name="input_seq[]" value="<?php echo $seq; ?>">
                    <?php echo $seq; ?>
                  </td>
                  <td><?php echo $count; ?></td>
                  <td><?php echo $weight; ?></td>
                  <td>
                    <input type="text" name="money[]" placeholder="금액을 입력하세요." value="<?php echo number_format($money); ?>" onkeyup="inputNumberFormat(this);">
                  </td>
                  <td>
                    <textarea name="other[]" rows="2" cols="30" placeholder="품명/재질/규격을 입력해주세요."><?php echo $ohter; ?></textarea>
                  </td>
                  <td>
                    <input type="date" name="pro_date[]" value="<?php echo $pro_date; ?>">
                  </td>
                  <td>
                    <input type="date" name="mp_date[]" value="<?php echo $mp_date; ?>">
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
