<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['STAT'] = '컷팅지 등록'; ?>
<?php $_SESSION['NAV'] = 'sub2'; ?>

<style>
    .loader_div p{
        position:absolute;
        top: 60%;
        left: 50%;
        transform: translate(-60%, -50%);
        font-weight: bold;
        font-size: 1.2em;
    }
    .loader {
        position: absolute;
        left: 50%;
        top: 50%;
        z-index: 1;
        width: 150px;
        height: 150px;
        margin: -75px 0 0 -75px;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 120px;
        height: 120px;
        -webkit-animation: spin 2s linear infinite;
        animation: spin 2s linear infinite;
    }

  @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }
</style>

<div class="loader_div" style="display: none;">
    <p>로딩중...</p>
    <div class="loader">
    </div>
</div>

<?php
  $por_no = $_GET['por_no'];
  $ho = substr($por_no, 0, 4);
  $por = substr($por_no, 4, 6);
?>

<div id="show" class="content sub01">
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

          <div class="flex">
            <h3>컷팅지 리스트</h3>
            <input type="button" onclick="history.back();" value="뒤로가기">
          </div>
          
          <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
            <form action="/hj/include/query2.php" method="post" enctype="multipart/form-data">
                <input type="file" name="cutting_file">
                <input type="hidden" name="cutting_por" value="<?php echo $por; ?>">
                <input type="hidden" name="cutting_ho" value="<?php echo $ho; ?>">
                
                <input type="submit" onclick="logData(this, '컷팅지 등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>', '<?php echo $_COOKIE['HPNAME']; ?>', '<?php echo $_SERVER['PHP_SELF']; ?>', '<?php echo $ho; ?>', '<?php echo $por; ?>', '<?php echo $seq; ?>', '<?php echo $qt_no; ?>');" value="파일 업로드">
            </form>
          <?php } ?>

          <?php if($_COOKIE['HPLEVEL'] == "관리") { ?>
          <div class="process_btn">
            <!-- <input type="button" onclick="add_weight();" value="중량 추가"> -->
            <input type="button" onclick="quantity_start2(<?php echo $ho; ?>, '<?php echo $por; ?>'); logData(this, '물량 산출', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="물량 산출">
            <input type="button" onclick="quantity_del2(<?php echo $ho; ?>, '<?php echo $por; ?>'); logData(this, '데이터 리셋', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="업로드 리셋">
            <input type="button" onclick="quantity_emg2(<?php echo $ho; ?>, '<?php echo $por; ?>'); logData(this, '긴급 물량등록', '<?php echo substr(date('Y-m-d h:i:s.u'), 0, 21); ?>', '<?php echo $_COOKIE['HPID']; ?>');" value="긴급 추가">
          </div>

          <div>
            <?php 
            $select_query = "SELECT MAX(qt_no * 1) AS MAX_qt_no FROM hj_lada WHERE quantity_ok IS NULL AND qt_no != '긴급' ";
            $select_result = mysqli_query($conn, $select_query);
            $row = mysqli_fetch_assoc($select_result);
            $MAX_qt_no = $row['MAX_qt_no'];
            
            if($MAX_qt_no === null) {
                $MAX_qt_no = 1;
            } else if($MAX_qt_no !== null) {
                $MAX_qt_no = $MAX_qt_no;
            }
            ?>
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
                  <!-- <td>공정리스트<br>제목</td> -->
                </tr>
              </thead>

              <tbody>
                <?php
                  $select_query = "SELECT * FROM hj_lada WHERE por = '$por' AND ho = '$ho' AND (hide_name IS NULL AND hide_date IS NULL)  ";
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
                    $hoop1 == 0 ? $hoop1 = '' : $hoop1;
                    $hoop2 == 0 ? $hoop2 = '' : $hoop2;
                    $count == 0 ? $count = '' : $count;
                    $weight == 0 ? $weight = '' : $weight;
                    $fr_one == 0 ? $fr_one = '' : $fr_one;
                    $fr_five == 0 ? $fr_five = '' : $fr_five;
                    $leg2_one == 0 ? $leg2_one = '' : $leg2_one;
                    $leg2_five == 0 ? $leg2_five = '' : $leg2_five;
                    $leg1_one == 0 ? $leg1_one = '' : $leg1_one;
                    $leg1_five == 0 ? $leg1_five = '' : $leg1_five;

                    //*********************** 2023-03-28. 김한얼 팀장. 라벨 마킹기 생산완료 매칭 표시 ***********************//
                    $select_query2 = "SELECT ship_no, por_no, seq_no, COUNT(ship_no) AS count FROM hj_label WHERE (ship_no = '$ho' AND por_no = '$por' AND seq_no = '$seq')  GROUP BY ship_no, por_no, seq_no";
                    // $select_result2 = mysqli_query($conn2, $select_query2);
                    // $row2 = mysqli_fetch_row($select_result2);

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
                        $select_quantity_query = "SELECT * FROM hj_lada WHERE ho = '$ho' AND por = '$por' AND seq = '$seq' AND qt_no IS NOT NULL ";
                        $select_quantity_result = mysqli_query($conn, $select_quantity_query);
                        $quantity_row = mysqli_fetch_assoc($select_quantity_result);
                        $quantity_ho = $quantity_row['ho'];
                        $quantity_por = $quantity_row['por'];
                        $quantity_seq = $quantity_row['seq'];
                        $quantity_qtNo = $quantity_row['qt_no'];
                        $quantity_list_title = $quantity_row['list_title'];
                        $quantity_qtOk = $quantity_row['quantity_ok'];

                        if(isset($quantity_ho) AND isset($quantity_por) AND isset($quantity_seq)) {
                            
                            if(isset($quantity_list_title) AND isset($quantity_qtNo) AND isset($quantity_qtOk)) {
                                echo "<input type='checkbox' disabled>";
                                echo "<br>";
                                echo "<p style='color: green; font-weight: bold;'>공정리스트</p>";
                                echo "[" . $quantity_list_title . "(" . $quantity_qtNo . ")" . "]";
                            } else if(!isset($quantity_list_title) AND isset($quantity_qtNo) AND isset($quantity_qtOk)) {
                                echo "<input type='checkbox' disabled>";
                                echo "<br>";
                                echo "<p style='color: blue; font-weight: bold;'>공정리스트 대기</p>";
                                echo "[" . $quantity_list_title . "(" . $quantity_qtNo . ")" . "]";
                            } else if(!isset($quantity_list_title) AND isset($quantity_qtNo) AND !isset($quantity_qtOk)) {
                                echo "<input type='checkbox' disabled>";
                                echo "<br>";
                                echo "<p style='color: red; font-weight: bold;'>물량산출</p>";
                                echo "[" . $quantity_list_title . "(" . $quantity_qtNo . ")" . "]";
                            }
                            
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
                  <td><?php echo htmlspecialchars($weight); ?></td>
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
