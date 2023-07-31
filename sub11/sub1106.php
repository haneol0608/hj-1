<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_name = $_GET['s_name'];
    $s_standard = $_GET['s_standard'];

    $search_str = "WHERE 1";
    
    if($s_name){
        $search_str .= " AND name LIKE '%$s_name%' ";
    }
    if($s_standard){
        $search_str .= " AND standard LIKE '%$s_standard%' ";
    }

?>
<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>원자재 정보 등록</h3>
            <div class="add_code">
              <ul>
                 <li>
                    <p>자재명</p>
                    <input type="text" name="name" placeholder="제품명을 입력해주세요">
                 </li>
                 <li><p>규격</p>
                    <input type="text" name="standard" placeholder="규격을 입력해주세요">
                 </li>
                 <li><p>수량</p>
                    <input type="text" name="count" placeholder="수량을 입력해주세요">
                 </li>
                 <li><input type="button" onclick="add_material(this)" value="등록"></li>
              </ul>
            </div>
        </div>
        <div class="sub_plate">
            <h3>원자재 검색</h3>
            <div class="add_code">
                <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_name=' . $s_name . '&s_standard=' . $s_standard ?>" method="get">
                    <table>
                        <tr>
                            <td>자재명</td>
                            <td><input type="text" name="s_name" placeholder="(검색어)제품명" value="<?php echo $s_name?>"></td>
                            <td>규격</td>
                            <td><input type="text" name="s_standard" placeholder="(검색어)규격" value="<?php echo $s_standard?>"></td>
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
          <h3>원자재 리스트</h3>
          <div class="code_list">
            <table class="<?php echo $style; ?>">
              <thead>
                <tr>
                  <td>NO</td>
                  <td>자재명</td>
                  <td>규격</td>
                  <td>수량</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query = "SELECT * FROM hj_material $search_str ORDER BY no DESC ";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $name = $row['name'];
                        $standard = $row['standard'];
                        $count = $row['count'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td onclick="user_click(this)">
                    <p><?php echo $name; ?></p>
                    <input style="display:none;" type="text" name="name2" value="<?php echo $name; ?>">
                  </td> 
                  <td style="text-align: left;" onclick="user_click(this)">
                    <p><?php echo $standard; ?></p>
                    <input style="display:none;" type="text" name="standard2" value="<?php echo $standard; ?>">
                  </td>   
                  <td style="text-align: right;" onclick="user_click(this)">
                    <p><?php echo $count; ?></p>
                    <input style="display:none; text-align: right;" type="text" name="count2" value="<?php echo $count; ?>">
                  </td>             
                  <td>
                    <input type="button" onclick="edit_material(this);" value="수정">
                    <input type="button" onclick="delete_material(this);" value="삭제">
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
