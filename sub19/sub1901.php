<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub19'; ?>
<!-- //header -->

<?php 
    $search_str = "WHERE 1 ";

    $search_equip = $_GET['search_equip'];
    $search_text = $_GET['search_text'];

    if($search_equip) { $search_str .= " AND equipment LIKE '%$search_equip%' "; }
    if($search_text) { $search_str .= " AND text LIKE '%$search_text%' "; }
?>

<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>점검일지 등록</h3>
            <div class="add_code">
              <ul>
                 <li><p>설비장비</p>
                    <input type="text" name="equipment" placeholder="장비명 입력">
                 </li>
                 <li style="width:60%;"><p>내용</p>
                    <textarea style="width:80%;" name="text" placeholder="점검내용을 입력해주세요."></textarea>
                 </li>
                 <li><input type="button" onclick="add_check(this)" value="등록"></li>
              </ul>
            </div>
        </div>

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>점검일지 검색</h3>
            <form action="<?php $_SERVER['PHP_SELF'] . '?search_equip=' . $search_equip . '&search_text=' . $search_text; ?>">
                <table>
                    <tr>
                        <td>설비장비</td>
                        <td><input style="width: 90%;" type="text" name="search_equip" value="<?php echo $search_equip; ?>"></td>
                        <td>내용</td>
                        <td><input style="width: 90%;" type="text" name="search_text" value="<?php echo $search_text; ?>"></td>
                        <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>점검일지 리스트</h3>
          <div class="code_list">
            <?php 
                $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                $table_result = mysqli_query($conn, $select_table_query);
                $table_row = mysqli_fetch_assoc($table_result);
                $style = $table_row['style'];
            ?>
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <td>NO</td>
                  <td style="width: 25%">설비장비</td>
                  <td>내용</td>
                  <td style="width: 15%">처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query = "SELECT * FROM hj_check $search_str ";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $equipment = $row['equipment'];
                        $text = $row['text'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td><p><?php echo $equipment; ?></p></td>
                  <td style="text-align: left;"><p><?php echo nl2br($text); ?></p></td>
                  <td>
                    <input type="button" onclick="delete_check(this)" value="삭제">
                  </td>
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
