<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_process = $_GET['s_process'];
    $s_power = $_GET['s_power'];
    $s_name = $_GET['s_name'];

    $search_str = "WHERE 1";
    
    if($s_process){
        $search_str .= " AND process = '$s_process' ";
    }
    if($s_power){
        $search_str .= " AND power = '$s_power' ";
    }
    if($s_name){
        $search_str .= " AND name LIKE '%$s_name%' ";
    }

?>

<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>공정 작업자 등록</h3>
            <div class="add_code">
              <ul>
                 <li><p>공정명</p>
                    <select name="process">
                     <option value="절단">절단</option>
                     <option value="벤딩">벤딩</option>
                     <option value="취부">취부</option>
                     <option value="용접">용접</option>
                     <option value="사상">사상</option>
                   </select>                
                 </li>
                 <li><p>권한</p>
                    <select name="power">
                     <option value="관리">관리</option>
                     <option value="직원">직원</option>
                   </select>  
                 </li>
                 <li><p>작업자명</p>
                    <input type="text" name="name" placeholder="작업자명을 입력해주세요.">
                 </li>
                 <li><input type="button" onclick="add_worker(this)" value="등록"></li>
              </ul>
            </div>
        </div>
        <div class="sub_plate">
            <h3>작업자 검색</h3>
            <div class="add_code">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_process=' . $s_process . '&s_power=' . $s_power . '&s_name=' . $s_name ?>" method="get">
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
                            <td>권한</td>
                            <td>
                                <select name="s_power">
                                    <option value="">-----</option>
                                    <option <?php if($s_power == "관리") {echo "selected"; } ?> value="관리">관리</option>
                                    <option <?php if($s_power == "직원") {echo "selected"; } ?> value="직원">직원</option>
                                </select>
                            </td>
                            <td>작업자명</td>
                            <td><input type="text" name="s_name" placeholder="(검색어)작업자명" value="<?php echo $s_name?>"></td>
                            <td><input style="width: 60%; height: 50px;" type="submit" value="검색"></td>
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
          <h3>작업자 리스트</h3>
          <div class="code_list">
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>공졍명</td>
                  <td>권한</td>
                  <td>작업자명</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query = "SELECT * FROM hj_worker $search_str ORDER BY no DESC ";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $process = $row['process'];
                        $power = $row['power'];
                        $name = $row['name'];
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
                  <td>
                    <select name="power2">
                      <?php if ($power == '관리') { ?>
                        <option value="관리">관리</option>
                        <option value="직원">직원</option>
                      <?php } else { ?>
                        <option value="직원">직원</option>
                        <option value="관리">관리</option>
                      <?php } ?>
                    </select>
                  </td><td onclick="user_click(this)">
                    <p><?php echo $name; ?></p>
                    <input style="display:none;" type="text" name="name2" value="<?php echo $name; ?>">
                  </td>                
                  <td>
                    <input type="button" onclick="edit_worker(this)" value="수정">
                    <input type="button" onclick="delete_worker(this)" value="삭제">
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
