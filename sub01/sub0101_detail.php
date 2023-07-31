<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['STAT'] = '컷팅지 등록'; ?>
<?php $_SESSION['NAV'] = 'sub1'; ?>

<?php
  $por_no = $_GET['por_no'];
  $ho = substr($por_no, 0, 4);
  $por = substr($por_no, 4, 6);
?>

<div class="content sub01">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
        <?php include 'product_menu.php'; ?>

      <div class="container sub01">
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
      </div>
      
      <div class="container sub01">
        <div class="sub_plate">
          <h3>컷팅지 리스트</h3>
          
          <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
            <form action="/hj/include/query.php" method="post" enctype="multipart/form-data">
                <input type="file" name="cutting_file">
                <input type="hidden" name="cutting_por" value="<?php echo $por; ?>">
                <input type="hidden" name="cutting_ho" value="<?php echo $ho; ?>">
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

                if($show_por == $por AND $show_ho == $ho) {
                ?>
                <input type="submit" value="파일 업로드" disabled>
            <?php } else { ?>
                <input type="submit" onclick="logData(this, '컷팅지 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="파일 업로드">
            <?php } ?>
            </form>
          <?php } ?>

          <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
          <div class="process_btn">
            <!-- <input type="button" onclick="add_weight();" value="중량 추가"> -->
            <input type="button" onclick="quantity_start(<?php echo $ho; ?>, '<?php echo $por; ?>'); logData(this, '물량 산출', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="물량 산출">
            <input type="button" onclick="quantity_del(<?php echo $ho; ?>, '<?php echo $por; ?>');" value="데이터 초기화">
            <input type="button" onclick="quantity_emg(<?php echo $ho; ?>, '<?php echo $por; ?>'); logData(this, '긴급 물량등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="긴급 추가">
          </div>

          <div>
            <input type="hidden" name="MAX_qt_no" value="<?php echo $MAX_qt_no; ?>">
            (현재 마지막 물량 번호 : <?php echo $MAX_qt_no; ?>)
          </div>
          <?php } ?>

          <div class="drawing_table_dt">
            <table>
              <thead>
                <tr>
                  <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                  <td>
                    <input id="all_check" type="checkbox" onclick="on_chk();">
                  </td>
                  <?php } ?>

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
                  $select_query = "SELECT * FROM hj_cutting WHERE por = '$por' AND ho = '$ho' ";
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

                  <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
                  <td>
                    <?php if($count !== '') { ?>
                    <?php 
                        $select_quantity_query = "SELECT * FROM hj_quantity WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' ";
                        $select_quantity_result = mysqli_query($conn, $select_quantity_query);
                        $quantity_row = mysqli_fetch_assoc($select_quantity_result);
                        $quantity_ho = $quantity_row['ho'];
                        $quantity_por = $quantity_row['por'];
                        $quantity_seq = $quantity_row['seq'];

                        if(isset($quantity_ho) AND isset($quantity_por) AND isset($quantity_seq)) {
                            echo "<input type='checkbox' disabled>";
                        } else {
                    ?>
                      <input type="hidden" name="quantity_ho" value="<?php echo $show_ho; ?>">
                      <input type="hidden" name="quantity_por" value="<?php echo $show_por; ?>">
                      <input type="hidden" name="quantity_count[]" value="<?php echo $count; ?>">
                      <input type="hidden" name="weight_in[]" value="<?php echo $weight; ?>">
                      <input class="sub_check" type="checkbox" name="quantity_seq[]" value="<?php echo $seq; ?>">
                      <?php } ?>
                    <?php } ?>
                  </td>
                  <?php } ?>
                  
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
