<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub17'; ?>
<!-- //header -->
<?php
  $search_str = "WHERE 1 ";

  $s_group_department = $_GET['s_group_department'];

  if($s_group_department) { 
    $search_str .= " AND group_department LIKE '%$s_group_department%' "; 
  }

?>
<div class="content sub10">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub17">
        <div class="sub_plate">
          <h3>사용자 그룹 추가</h3>
          <div class="add_user">
            <ul>
              <li>사용자 그룹<span><input type="text" name="group_department"></span></li>
            </ul>
            <ul>
              <li><input type="submit" onclick="add_group();" value="등록"></li>
            </ul>
          </div>
        </div>

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>사용자 그룹 검색</h3>
            <form action="<?php  $_SERVER['PHP_SELF'] . '?s_group_department=' . $s_group_department; ?>">
                <table>
                    <tr>
                        <td>부서</td>
                        <td><input style="width: 90%;" type="text" name="s_group_department" placeholder="(검색)부서" value="<?php echo $s_group_department; ?>"></td>
                        <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>사용자 그룹 리스트</h3>
          <div class="user_table">
            <table>
              <thead>
                <tr>
                  <td>NO</td>
                  <td>부서</td>
                  <td>처리</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  $select_query = "SELECT * FROM hj_group $search_str";
                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $i++;
                    $no = htmlspecialchars($row['no']);
                    $group_department = htmlspecialchars($row['group_department']);
                    $group_power = htmlspecialchars($row['group_power']);
                 ?>
                <tr>
                  <td>
                    <input type="hidden" name="up_group_no" value="<?php echo $no; ?>">
                    <?php echo $i; ?>
                  </td>
                  <td onclick="user_click(this);">
                    <input style="display:none;" type="text" name="up_group_department" value="<?php echo $group_department; ?>">
                    <p><?php echo $group_department; ?></p>
                  </td>
                  <td>
                    <input type="button" onclick="group_update(this);" value="수정">
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
<!-- <script type="text/javascript" src="/jd/include/js/script.js"></script> -->
