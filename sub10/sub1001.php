<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub10'; ?>
<!-- //header -->

<div class="content sub10">
  <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
    <div class="container_ct">
      <div class="container sub10">
        <div class="sub_plate">
          <h3>계정 추가</h3>
          <div class="add_user">
            <ul>
              <li>부서<span><input type="text" name="user_department"></span></li>
              <li>성명<span><input type="text" name="user_name"></span></li>
              <li>직급<span><input type="text" name="user_rank"></span></li>
              <li>아이디<span><input type="text" name="user_id"></span></li>
              <li>비밀번호<span><input type="password" name="user_pw"></span></li>
              <li>연락처<span><input type="text" name="user_contact"></span></li>
              <li>권한
                <span>
                  <div><input type="radio" name="user_power" value="관리">관리</div>
                  <div><input type="radio" name="user_power" value="사원">사원</div>
                </span>
              </li>
            </ul>
            <ul>
              <li><input type="submit" onclick="add_user(this);" value="등록"></li>
            </ul>
          </div>
        </div>
        <div class="sub_plate_user">
          <h3>계정 리스트</h3>
          <div class="user_table">
            <table>
              <thead>
                <tr>
                  <td>NO</td>
                  <td>부서</td>
                  <td>성명</td>
                  <td>직급</td>
                  <td>아이디</td>
                  <td>비밀번호</td>
                  <td>연락처</td>
                  <td>권한</td>
                  <td>비고</td>
                </tr>
              </thead>
              <tbody>
                <?php
                  $select_query = "SELECT * FROM hj_user WHERE user_id != 'admin' ";
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
                    <input style="display:none;" type="text" name="up_user_id" value="<?php echo $user_id; ?>">
                    <p><?php echo $user_id; ?></p>
                  </td>
                  <td onclick="user_click(this);">
                    <!-- <input class="input_pw" type="password" name="current_password" placeholder="현재 비밀번호"> -->
                    <input class="input_pw" type="password" name="new_password" placeholder="신규 비밀번호">
                  </td>
                  <td onclick="user_click(this);">
                    <input style="display:none"; type="text" name="up_user_contact" value="<?php echo $user_contact; ?>">
                    <p><?php echo $user_contact; ?></p>
                  </td>
                  <td>
                    <label>현재 권한 : <?php echo "$user_power"; ?><br></label>
                    <?php if($user_power == "관리") { ?>
                      <input type="radio" name="up_user_power" value="사원"><label>사원</label>
                    <?php } ?>
                    <?php if($user_power == "사원") { ?>
                    <input type="radio" name="up_user_power" value="관리"><label>관리</label>
                    <?php } ?>
                  </td>
                  <td>
                    <input type="submit" name="update_user" onclick="user_update(this);" value="수정">
                    <input type="submit" name="delete_user" onclick="user_delete(this);" value="삭제">
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
