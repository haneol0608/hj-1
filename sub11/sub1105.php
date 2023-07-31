<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_type = $_GET['s_type'];
    $s_name = $_GET['s_name'];

    $search_str = "WHERE 1";
    
    if($s_type){
        $search_str .= " AND type = '$s_type' ";
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
          <h3>완제품 정보 등록</h3>
            <div class="add_code">
              <ul>
                 <li><p>분류</p>
                   <select name="type">
                     <option value="사다리">사다리</option>
                     <option value="각철">각철</option>
                     <option value="벤딩 핸드레일">벤딩 핸드레일</option>
                   </select>
                 </li>
                 <li>
                   <p>제품명</p>
                 <input type="text" name="name" placeholder="제품명을 입력해주세요">
                 </li>
                 <li><input type="button" onclick="add_product(this)" value="등록"></li>
              </ul>
            </div>
        </div>
        <div class="sub_plate">
            <h3>완제품 검색</h3>
            <div class="add_code">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_type=' . $s_type . '&s_name=' . $s_name ?>" method="get">
                    <table>
                        <tr>
                            <td>분류</td>
                            <td>
                                <select name="s_type">
                                    <option value="">----</option>
                                    <option <?php if($s_type == "사다리") {echo "selected"; } ?> value="사다리">사다리</option>
                                    <option <?php if($s_type == "각철") {echo "selected"; } ?> value="각철">각철</option>
                                    <option <?php if($s_type == "벤딩 핸드레일") {echo "selected"; } ?> value="벤딩 핸드레일">벤딩 핸드레일</option>
                                </select>
                            </td>
                            <td>제품명</td>
                            <td><input type="text" name="s_name" placeholder="(검색어)제품명" value="<?php echo $s_name?>"></td>
                            <td><input style="width: 60%; height: 50px;" type="submit" value="검색"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <form name="upload_common" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" onsubmit="all_reset()">
        <div class="sub_plate">
          <?php 
            $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
            $table_result = mysqli_query($conn, $select_table_query);
            $table_row = mysqli_fetch_assoc($table_result);
            $style = $table_row['style'];
          ?>
          <h3>완제품 리스트</h3>
          <div class="code_list">
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>분류</td>
                  <td>완제품명</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query = "SELECT * FROM hj_product $search_str ORDER BY no DESC ";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $type = $row['type'];
                        $name = $row['name'];
                    ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td>
                    <select name="type2">
                      <?php if ($type == '사다리') { ?>
                        <option value="사다리" selected>사다리</option>
                        <option value="각철">각철</option>
                        <option value="벤딩 핸드레일">벤딩 핸드레일</option>
                      <?php } else if($type == '각철') { ?>
                        <option value="각철" selected>각철</option>
                        <option value="사다리">사다리</option>
                        <option value="벤딩 핸드레일">벤딩 핸드레일</option>
                      <?php } else if($type == '벤딩 핸드레일') { ?>
                        <option value="벤딩 핸드레일" selected>벤딩 핸드레일</option>
                        <option value="사다리">사다리</option>
                        <option value="각철">각철</option>
                      <?php } ?>
                    </select>
                  </td>
                  <td onclick="user_click(this)">
                    <p><?php echo $name; ?></p>
                    <input style="display:none;" type="text" name="name2" value="<?php echo $name; ?>">
                  </td>                
                  <td>
                    <input type="button" onclick="edit_product(this)" value="수정">
                    <input type="button" onclick="delete_product(this)" value="삭제">
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
