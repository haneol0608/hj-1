<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_process = $_GET['s_process'];
    $s_sequence = $_GET['s_sequence'];
    $s_corrective = $_GET['s_corrective'];
    $s_precaution = $_GET['s_precaution'];

    $search_str = "WHERE 1";
    
    if($s_process){
        $search_str .= " AND process = '$s_process' ";
    }
    if($s_sequence){
        $search_str .= " AND sequence LIKE '%$s_sequence%' ";
    }
    if($s_corrective){
        $search_str .= " AND corrective LIKE '%$s_corrective%' ";
    }
    if($s_precaution){
        $search_str .= " AND precaution LIKE '%$s_precaution%' ";
    }

?>

<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>작업표준서 등록</h3>
            <div class="add_code">
                <ul>
                    <li>
                        <p>공정명</p>
                        <select name="process">
                            <option value="절단">절단</option>
                            <option value="벤딩">벤딩</option>
                            <option value="취부">취부</option>
                            <option value="용접">용접</option>
                            <option value="사상">사상</option>
                        </select>                
                    </li>
                    <li>
                        <p>작업순서</p>
                        <textarea name="sequence" placeholder="작업순서 입력해주세요."></textarea>
                    </li>
                    <li>
                        <p>조치사항</p>
                        <textarea name="corrective" placeholder="조치사항 입력해주세요."></textarea>
                    </li>
                    <li>
                        <p>주의사항</p>
                        <textarea name="precaution" placeholder="주의사항 입력해주세요."></textarea>
                    </li>
                    <li>
                        <input type="button" onclick="add_sop(this)" value="등록">
                    </li>
                </ul>
            </div>
        </div>
        <div class="sub_plate">
            <h3>작업표준서 검색</h3>
            <div class="add_code">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_process=' . $s_process . '&search=' . $search . '&s_corrective=' . $s_corrective . '&s_precaution=' . $s_precaution ?>" method="get">
                    <table>
                        <tr>
                            <td>공정명</td>
                            <td>
                                <select name="s_process">
                                    <option value="">-----</option>
                                    <option <?php if($s_process == "절단") {echo "selected"; } ?> value="절단">절단</option>
                                    <option <?php if($s_process == "벤딩") {echo "selected"; } ?> value="벤딩">벤딩</option>
                                    <option <?php if($s_process == "취부") {echo "selected"; } ?> value="취부">취부</option>
                                    <option <?php if($s_process == "용접") {echo "selected"; } ?> value="용접">용접</option>
                                    <option <?php if($s_process == "사상") {echo "selected"; } ?> value="사상">사상</option>
                                </select>
                            </td>
                            <td>작업순서</td>
                            <td><input type="text" name="s_sequence" placeholder="(검색어)작업순서" value="<?php echo $s_sequence?>"></td>
                            <td>조치사항</td>
                            <td><input type="text" name="s_corrective" placeholder="(검색어)조치사항" value="<?php echo $s_corrective?>"></td>
                            <td>주의사항</td>
                            <td><input type="text" name="s_precaution" placeholder="(검색어)주의사항" value="<?php echo $s_precaution?>"></td>
                            <td><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="sub_plate">
          <?php 
            $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
            $table_result = mysqli_query($conn, $select_table_query);
            $table_row = mysqli_fetch_assoc($table_result);
            $style = $table_row['style'];
          ?>
          <h3>작업표준서 리스트</h3>
          <div class="code_list">
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <td>NO</td>
                  <td style="width: 15%">공정명</td>
                  <td>작업순서</td>
                  <td>조치사항</td>
                  <td>주의사항</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query = "SELECT * FROM hj_sop $search_str ORDER BY no DESC ";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $process = $row['process'];
                        $sequence = $row['sequence'];
                        $corrective = $row['corrective'];
                        $precaution = $row['precaution'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td>
                    <select name="process2">
                        <option value="">-----</option>
                        <option <?php if($process == "절단") {echo "selected"; } ?> value="절단">절단</option>
                        <option <?php if($process == "벤딩") {echo "selected"; } ?> value="벤딩">벤딩</option>
                        <option <?php if($process == "취부") {echo "selected"; } ?> value="취부">취부</option>
                        <option <?php if($process == "용접") {echo "selected"; } ?> value="용접">용접</option>
                        <option <?php if($process == "사상") {echo "selected"; } ?> value="사상">사상</option>
                    </select>
                  </td>
                  <td onclick="user_click2(this)">
                    <p><?php echo nl2br($sequence); ?></p>
                    <textarea style="display:none;" type="text" name="sequence2"><?php echo $sequence; ?></textarea>
                  </td>
                  <td onclick="user_click2(this)">
                    <p><?php echo nl2br($corrective); ?></p>
                    <textarea style="display:none;" type="text" name="corrective2"><?php echo $corrective; ?></textarea>
                  </td>
                  <td onclick="user_click2(this)">
                    <p><?php echo nl2br($precaution); ?></p>
                    <textarea style="display:none;" type="text" name="precaution2"><?php echo $precaution; ?></textarea>
                  </td>                
                  <td>
                    <input type="button" onclick="edit_sop(this)" value="수정">
                    <input type="button" onclick="delete_sop(this)" value="삭제">
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
