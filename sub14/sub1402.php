<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub14'; ?>
<!-- //header -->
<?php 
    $search_str = "AND 1 ";

    $s_account = $_GET['s_account'];
    $s_name = $_GET['s_name'];
    $s_date1 = $_GET['s_date1'];
    $s_date2 = $_GET['s_date2'];
    $date = date("Y-M-d");

    if($s_account) { 
        $search_str .= " AND account = '$s_account' "; 
    }
    if($s_name) { 
        $search_str .= " AND name LIKE '%$s_name%' "; 
    }
    if($s_date1 && $s_date2) { 
        $search_str .= " AND date BETWEEN '$s_date1' AND '$s_date2' "; 
    } else{
        if ($s_date1 && !$s_date2){
            $search_str .= " AND date BETWEEN '$s_date1' AND '$date' "; 
        }
    }
?>
<div class="content sub07">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub07">
        <!-- <h2>공통코드 리스트</h2> -->
        <div class="sub_plate">
          <h3>출하지시 등록</h3>
            <div class="add_code">
              <ul>
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
                 <li><p>출하지시</p>
                    <input type="text" name="name">
                 </li>
                 <li><p>지시일</p>
                    <input type="date" name="date">
                 </li>
                 <li><input type="button" onclick="add_shipment(this)" value="등록"></li>
              </ul>
            </div>
        </div>
        <div class="sub_plate">
            <h3>출하지시 검색</h3>
            <div class="add_code">
                <form action="<?php $_SERVER['PHP_SELF'] . '?s_account=' . $name2 . '&s_name=' . $s_name . '&s_date1=' . $s_date1. '&s_date2=' . $s_date2; ?>">
                    <table>
                        <tr>
                            <td>거래처</td>
                            <td>
                                <select name="s_account">
                                    <option value="">----</option>
                                    <?php 
                                        $select_query = "SELECT * FROM hj_account";
                                        $select_result = mysqli_query($conn, $select_query);
                                        while($row = mysqli_fetch_assoc($select_result)) {
                                            $no = $row['no'];
                                            $name2 = $row['name'];
                                    ?>
                                    <option  <?php if($s_account == "$name2") {echo "selected"; } ?>  value="<?php echo $name2; ?>"><?php echo $name2; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                            <td>출하지시</td>
                            <td><input type="text" name="s_name" value="<?php echo $s_name; ?>"></td>
                            <td>지시일</td>
                            <td>
                                <input type="date" name="s_date1" value="<?php echo $s_date1; ?>">~
                                <input type="date" name="s_date2" value="<?php echo $s_date2; ?>">
                            </td>
                            <td><input style="width: 80%; height: 50px;" type="submit" value="검색"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="sub_plate">
          <h3>출하지시 리스트</h3>
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
                  <td>거래처</td>
                  <td>출하지시명</td>
                  <td>지시일</td>
                  <td>출하지시</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query2 = "SELECT * FROM hj_shipment WHERE stat = '미출하' $search_str ";
                    $select_result2 = mysqli_query($conn, $select_query2);
                    $i = 0;
                    while($row2 = mysqli_fetch_assoc($select_result2)) {
                        $i++;
                        $no = $row2['no'];
                        $account = $row2['account'];
                        $name = $row2['name'];
                        $date = $row2['date'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td><p><?php echo $account; ?></p></td>
                  <td onclick="user_click(this)">
                    <p><?php echo $name; ?></p>
                    <input style="display:none;" type="text" name="name2" value="<?php echo $name; ?>">
                  </td>
                  <td><p><?php echo $date; ?></p></td> 
                  <td>
                    <input type="button" onclick="edit_stat(this)" value="출하">
                  </td>
                  <td>
                    <input type="button" onclick="edit_shipment(this)" value="수정">
                    <input type="button" onclick="delete_shipment(this)" value="삭제">
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
