<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub14'; ?>
<!-- //header -->
<?php 
    $search_str = "WHERE 1 ";

    $search_code = $_GET['search_code'];
    $search_account = $_GET['search_account'];
    $search_text = $_GET['search_text'];

    if($search_code) { $search_str .= " AND code LIKE '%$search_code%' "; }
    if($search_account) { $search_str .= " AND account LIKE '%$search_account%' "; }
    if($search_text) { $search_str .= " AND text LIKE '%$search_text%' "; }
?>

<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">

        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>수송지시 등록</h3>
            <div class="add_code">
              <ul>
                 <li><p>수송코드</p>
                    <input name="code" type="text">
                 </li>
                 <li><p>수송지시 내용</p>
                    <input name="text" type="text">
                 </li>
                 <li><p>거래처</p>
                    <select name="account">
                        <option value="">----</option>
                        <?php 
                            $select_query = "SELECT * FROM hj_account";
                            $select_result = mysqli_query($conn, $select_query);
                            while($row = mysqli_fetch_assoc($select_result)) {
                                $no = $row['no'];
                                $name = $row['name'];
                        ?>
                        <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                        <?php } ?>
                    </select>
                 </li>
                 <li><input type="button" onclick="add_trans(this)" value="등록"></li>
              </ul>
            </div>
        </div>
        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>수송지시 검색</h3>
            <div class="add_code">
                <form action="<?php $_SERVER['PHP_SELF'] . '?search_code=' . $search_code . '&search_account=' . $search_account . '&search_text=' . $search_text; ?>">
                    <table>
                        <tr>
                            <td>수송코드</td>
                            <td><input type="text" name="search_code" value="<?php echo $search_code; ?>"></td>
                            <td>거래처</td>
                            <td><input type="text" name="search_account" value="<?php echo $search_account; ?>"></td>
                            <td>내용</td>
                            <td><input type="text" name="search_text" value="<?php echo $search_text; ?>"></td>
                            <td><input style="width: 80%; height: 50px;" type="submit" value="검색"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <!-- ************************************************************************************ -->
        <div class="sub_plate">
          <h3>수송지시 리스트</h3>
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
                  <td>수송코드</td>
                  <td>내용</td>
                  <td>거래처</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query2 = "SELECT * FROM hj_trans $search_str";
                    $select_result2 = mysqli_query($conn, $select_query2);
                    $i = 0;
                    while($row2 = mysqli_fetch_assoc($select_result2)) {
                        $i++;
                        $no = $row2['no'];
                        $code = $row2['code'];
                        $text = $row2['text'];
                        $account = $row2['account'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td onclick="user_click(this)">
                    <p><?php echo $code; ?></p>
                    <input style="display:none;" type="text" name="code2" value="<?php echo $code; ?>">
                  </td> 
                  <td onclick="user_click(this)">
                    <p><?php echo $text; ?></p>
                    <input style="display:none;" type="text" name="text2" value="<?php echo $text; ?>">
                  </td>
                  <td onclick="user_click(this)">
                    <p><?php echo $account; ?></p>
                    <input style="display:none;" type="text" name="account2" value="<?php echo $account; ?>">
                  </td>                
                  <td>
                    <input type="button" onclick="edit_trans(this)" value="수정">
                    <input type="button" onclick="delete_trans(this)" value="삭제">
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
