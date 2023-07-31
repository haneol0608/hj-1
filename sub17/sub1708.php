<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub17'; ?>
<!-- //header -->
<?php
  $search_str = "WHERE 1 ";

  $s_user_department = $_GET['s_user_department'];
  $s_user_name = $_GET['s_user_name'];
  $s_user_rank = $_GET['s_user_rank'];

  if($s_user_department) { 
    $search_str .= " AND user_department LIKE '%$s_user_department%' "; 
  }
  if($s_user_name) { 
    $search_str .= " AND user_name LIKE '%$s_user_name%' "; 
  }
  if($s_user_rank) { 
    $search_str .= " AND user_rank LIKE '%$s_user_rank%' "; 
  }
?>
<div class="content sub10">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub17">

        <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
        <div class="sub_plate">
            <h3>사용자 검색</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_group_department=' . $s_group_department . '&s_group_power=' . $s_group_power; ?>">
                <table>
                    <tr>
                        <td>부서</td>
                        <td>
                            <input style="width: 90%;" type="text" name="s_user_department" placeholder="(검색어)부서" value="<?php echo $s_user_department; ?>">
                        </td>
                        <td>성명</td>
                        <td>
                            <input style="width: 90%;" type="text" name="s_user_name" placeholder="(검색어)성명" value="<?php echo $s_user_name; ?>">
                        </td>
                        <td>직급</td>
                        <td>
                            <input style="width: 90%;" type="text" name="s_user_rank" placeholder="(검색어)직급" value="<?php echo $s_user_rank; ?>">
                        </td>
                        <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                    </tr>
                </table>
            </form>
        </div>
        <!-- ************************************************************************************ -->

        <div class="sub_plate">
          <h3>사용자 화면 설정</h3>
          <div class="user_table">
            <table>
              <thead>
                <tr>
                  <td>NO</td>
                  <td>부서</td>
                  <td>성명</td>
                  <td>직급</td>
                  <td>연락처</td>
                  <td>화면설정</td>
                  <td>비고</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  $select_query = "SELECT * FROM hj_user $search_str ";
                  $select_result = mysqli_query($conn, $select_query);
                  while($row = mysqli_fetch_assoc($select_result)) {
                    $i++;
                    $no = htmlspecialchars($row['no']);
                    $user_department = htmlspecialchars($row['user_department']);
                    $user_name = htmlspecialchars($row['user_name']);
                    $user_rank = htmlspecialchars($row['user_rank']);
                    $user_id = htmlspecialchars($row['user_id']);
                    $user_pw = htmlspecialchars($row['user_pw']);
                    $user_contact = htmlspecialchars($row['user_contact']);
                    $user_power = htmlspecialchars($row['user_power']);
                 ?>
                <tr>
                  <td>
                    <input type="hidden" name="up_no" value="<?php echo $no; ?>">
                    <?php echo $i; ?>
                  </td>
                  <td onclick="user_click(this);">
                    <input style="display:none;" type="text" name="up_user_department" value="<?php echo $user_department; ?>">
                    <p><?php echo $user_department; ?></p>
                  </td>
                  <td onclick="user_click(this);">
                    <input style="display:none;" type="text" name="up_user_name" value="<?php echo $user_name; ?>">
                    <p><?php echo $user_name; ?></p>
                  </td>
                  <td onclick="user_click(this);">
                    <input style="display:none;" type="text" name="up_user_rank" value="<?php echo $user_rank; ?>">
                    <p><?php echo $user_rank ?></p>
                  </td>
                 
                  <td onclick="user_click(this);">
                    <input style="display:none"; type="text" name="up_user_contact" value="<?php echo $user_contact; ?>">
                    <p><?php echo $user_contact; ?></p>
                  </td>
                  <td>
                    <label>현재 화면 : <?php echo "$user_power" . ' 화면'; ?><br></label>
                    <?php if($user_power == "관리") { ?>
                      <input type="radio" name="up_user_power" value="사원"><label>사원 화면</label>
                    <?php } ?>
                    <?php if($user_power == "사원") { ?>
                    <input type="radio" name="up_user_power" value="관리"><label>관리 화면</label>
                    <?php } ?>
                  </td>
                  <td>
                    <input type="submit" name="update_user" onclick="user_update(this)" value="수정">
                    <!-- <input type="submit" name="delete_user" onclick="user_delete(this)" value="삭제"> -->
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
