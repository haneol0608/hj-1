<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub19'; ?>
<!-- //header -->
<?php 
    $search_str = "WHERE 1 ";

    $s_equipment = $_GET['s_equipment'];
    $s_status = $_GET['s_status'];
    $s_plc = $_GET['s_plc'];
    $s_cloud = $_GET['s_cloud'];
    $s_date1 = $_GET['s_date1'];
    $s_date2 = $_GET['s_date2'];
    $date = date('Y-m-d');

    if($s_equipment) { 
        $search_str .= " AND equipment LIKE '%$s_equipment%' "; 
    }
    if($s_status) { 
        $search_str .= " AND status = '$s_status' "; 
    }
    if($s_plc) { 
        $search_str .= " AND plc = '$s_plc' "; 
    }
    if($s_cloud) { 
        $search_str .= " AND cloud = '$s_cloud' "; 
    }
    if($s_date1 && $s_date2) { 
        $search_str .= " AND date BETWEEN '$s_date1' AND '$s_date2' "; 
    } else{
        if($s_date1 && !$s_date2){
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
          <h3>설비이력 등록</h3>
            <div class="add_code">
              <ul>
                 <li>
                    <p>설비장비</p>
                    <input type="text" name="equipment" placeholder="장비명 입력">
                 </li>
                 <li>
                    <p>연결상태</p>
                    <select name="status">
                        <option value="자동">자동</option>
                        <option value="수동">수동</option>
                    </select>
                 </li>
                 <li>
                    <p>PLC 연결</p>
                    <select name="plc">
                        <option value="연결">연결</option>
                        <option value="미연결">미연결</option>
                    </select>
                 </li>
                 <li>
                    <p>클라우드 연결</p>
                    <select name="cloud">
                        <option value="연결">연결</option>
                        <option value="미연결">미연결</option>
                    </select>
                 </li>
                 <li>
                    <p>정보 등록일</p>
                    <input type="date" name="date" value="<?php echo date('Y-d-m');?>">
                 </li>
                 <li>
                    <input type="button" onclick="add_record(this)" value="등록">
                </li>
              </ul>
            </div>
        </div>
        <div class="sub_plate">
          <h3>설비이력 검색</h3>
            <form action="<?php $_SERVER['PHP_SELF'] . '?s_equipment=' . $s_equipment . '&s_status=' . $s_status . '&s_plc=' . $s_plc . '&s_cloud=' . $s_cloud . '&s_date1=' . $s_date1 . '&s_date2=' . $s_date2; ?>">
                <table>
                    <tr>
                        <td>설비장비</td>
                        <td><input style="width: 90%;" type="text" name="s_equipment" placeholder="장비명 입력" value="<?php echo $s_equipment; ?>"></td>
                        <td>연결상태</td>
                        <td>
                            <select name="s_status" style="width: 90%;" name="status">
                                <option value="">-----</option>
                                <option <?php if($s_status == "자동") {echo "selected"; } ?> value="자동">자동</option>
                                <option <?php if($s_status == "수동") {echo "selected"; } ?> value="수동">수동</option>
                            </select>
                        </td>
                        <td>PLC 연결</td>
                        <td>
                            <select name="s_plc" style="width: 90%;" name="plc">
                                <option value="">-----</option>
                                <option <?php if($s_plc == "연결") {echo "selected"; } ?> value="연결">연결</option>
                                <option <?php if($s_plc == "미연결") {echo "selected"; } ?> value="미연결">미연결</option>
                            </select>
                        </td>
                        <td>클라우드 연결</td>
                        <td>
                            <select name="s_cloud" style="width: 90%;" name="s_cloud">
                            <option value="">-----</option>
                                <option <?php if($s_cloud == "연결") {echo "selected"; } ?> value="연결">연결</option>
                                <option <?php if($s_cloud == "미연결") {echo "selected"; } ?> value="미연결">미연결</option>
                            </select>
                        </td>
                        <td>정보 등록일</td>
                        <td>
                            <input type="date" name="s_date1" value="<?php echo $s_date1; ?>">~
                            <input type="date" name="s_date2" value="<?php echo $s_date2 ?>">
                        </td>
                        <td><input rowspan="3" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
        </div>

        <div class="sub_plate">
          <h3>설비이력 리스트</h3>
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
                  <td>설비장비</td>
                  <td>연결상태</td>
                  <td>PLC 연결</td>
                  <td>클라우드 연결</td>
                  <td>등록일</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                    $select_query = "SELECT * FROM hj_system_record $search_str";
                    $select_result = mysqli_query($conn, $select_query);
                    $i = 0;
                    while($row = mysqli_fetch_assoc($select_result)) {
                        $i++;
                        $no = $row['no'];
                        $equipment = $row['equipment'];
                        $status = $row['status'];
                        $plc = $row['plc'];
                        $cloud = $row['cloud'];
                        $date = $row['date'];
                ?>
                <tr>
                  <td>
                      <?php echo $i; ?>
                      <input type="hidden" name="no" value="<?php echo $no; ?>">
                  </td>
                  <td><p><?php echo $equipment; ?></p></td>
                  <td><p><?php echo $status; ?></p></td>
                  <td><p><?php echo $plc; ?></p></td>
                  <td><p><?php echo $cloud; ?></p></td>
                  <td><p><?php echo $date; ?></p></td>
                  <td>
                    <input type="button" onclick="delete_record(this)" value="삭제">
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
