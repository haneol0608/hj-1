<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_type = $_GET['s_type'];
    $s_name = $_GET['s_name'];
    $s_code = $_GET['s_code'];
    $s_possible = $_GET['s_possible'];

    $search_str = "WHERE 1";
    
    if($s_type){
        $search_str .= " AND type = '$s_type' ";
    }
    if($s_name){
        $search_str .= " AND name LIKE '%$s_name%' ";
    }
    if($s_code){
        $search_str .= " AND code LIKE '%$s_code%' ";
    }
    if($s_possible){
        $search_str .= " AND possible = '$s_possible' ";
    }
    
?>

<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>공통코드 등록</h3>
            <div class="add_code">
              <ul>
                 <li><p>분류</p>
                   <select name="type">
                     <option value="자재">자재</option>
                     <option value="완제품">완제품</option>
                   </select>
                 </li>
                   <li><p>코드명</p>
                     <input type="text" name="name" placeholder="코드명을 입력해주세요">
                   </li>
                   <li><p>공통코드</p>
                     <input type="text" name="code" placeholder="코드를 입력해주세요">
                   </li>
                   <li><p>사용여부</p>
                     <select name="possible">
                       <option value="Y">사용</option>
                       <option value="N">미사용</option>
                     </select>
                   </li>
                   <li><input type="button" onclick="add_code(this)" value="등록"></li>
              </ul>
            </div>
        </div>
        <div class="sub_plate">
            <h3>공통코드 검색</h3>
            <div class="add_code">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_type=' . $s_type . '&s_name=' . $s_name . '&s_code=' . $s_code . '&s_possible=' . $s_possible ?>" method="get">
                    <table>
                        <tr>
                            <td>분류</td>
                            <td>
                                <select name="s_type">
                                    <option value="">----</option>
                                    <option <?php if($s_type == "자재") {echo "selected"; } ?> value="자재">자재</option>
                                    <option <?php if($s_type == "완제품") {echo "selected"; } ?> value="완제품">완제품</option>
                                </select>
                            </td>
                            <td>코드명</td>
                            <td><input type="text" name="s_name" placeholder="(검색어)코드명" value="<?php echo $s_name?>"></td>
                            <td>공통코드</td>
                            <td><input type="text" name="s_code" placeholder="(검색어)코드" value="<?php echo $s_code?>"></td>
                            <td>사용여부</td>
                            <td>
                                <select name="s_possible">
                                    <option value="">----</option>
                                    <option <?php if($s_possible == "Y") {echo "selected"; } ?> value="Y">사용</option>
                                    <option <?php if($s_possible == "N") {echo "selected"; } ?>value="N">미사용</option>
                                </select>
                            </td>
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
          <h3>공통코드 리스트</h3>
          <div class="code_list">
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>분류</td>
                  <td>코드명</td>
                  <td>코드</td>
                  <td>사용여부</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    
                    $select_query = "SELECT * FROM hj_code $search_str ORDER BY no DESC ";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $type = $row['type'];
                        $name = $row['name'];
                        $code = $row['code'];
                        $possible = $row['possible'];
                    ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td>
                    <select name="type2">
                      <?php if ($type == '자재') { ?>
                        <option value="자재">자재</option>
                        <option value="완제품">완제품</option>
                      <?php } else { ?>
                        <option value="완제품">완제품</option>
                        <option value="자재">자재</option>
                      <?php } ?>
                    </select>
                  </td>
                  <td><p><?php echo $name; ?></p></td>
                  <td><p><?php echo $code; ?></p></td>
                  <td>
                     <select name="possible2">
                      <?php if ($possible == 'Y') { ?>
                        <option value="Y">사용</option>
                        <option value="N">미사용</option>
                      <?php } else { ?>
                        <option value="N">미사용</option>
                        <option value="Y">사용</option>
                      <?php } ?>
                    </select>
                  </td>
                  <td>
                    <input type="button" onclick="delete_code(this)" value="삭제">
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
