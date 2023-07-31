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
  $s_user_id = $_GET['s_user_id'];

  if($s_user_department) { 
    $search_str .= " AND user_department LIKE '%$s_user_department%' "; 
  }
  if($s_user_name) { 
    $search_str .= " AND user_name LIKE '%$s_user_name%' "; 
  }
  if($s_user_rank) { 
    $search_str .= " AND user_rank LIKE '%$s_user_rank%' "; 
  }
  if($s_user_id) { 
    $search_str .= " AND user_id LIKE '%$s_user_id%' "; 
  }

?>
<div class="content sub10">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub17">

                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>암호정보 검색</h3>
                    <form action="<?php $_SERVER['PHP_SELF'] . '?s_user_department=' . $s_user_department . '&s_user_name=' . $s_user_name . '&s_user_rank=' . $s_user_rank . '&s_user_id=' . $s_user_id; ?>">
                        <table>
                            <tr>
                                <td>부서</td>
                                <td><input style="width: 90%;" type="text" name="s_user_department" placeholder="(검색어)부서" value="<?php echo $s_user_department; ?>"></td>
                                <td>성명</td>
                                <td><input type="text" name="s_user_name" placeholder="(검색어)성명" value="<?php echo $s_user_name; ?>"></td>
                                <td>직급</td>
                                <td><input type="text" name="s_user_rank" placeholder="(검색어)직급" value="<?php echo $s_user_rank; ?>"></td>
                                <td>아이디</td>
                                <td><input type="text" name="s_user_id" placeholder="(검색어)아이디" value="<?php echo $s_user_id; ?>"></td>
                                <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- ************************************************************************************ -->

                <div class="sub_plate">
                    <h3>암호변경 리스트</h3>
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
                                    <td>비고</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_user $search_str";
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
                                        <input type="hidden" name="pw_no" value="<?php echo $no; ?>">
                                        <?php echo $i; ?>
                                    </td>
                                    <td onclick="user_click(this);">
                                        <p><?php echo $user_department; ?></p>
                                    </td>
                                    <td onclick="user_click(this);">
                                        <p><?php echo $user_name; ?></p>
                                    </td>
                                    <td onclick="user_click(this);">
                                        <p><?php echo $user_rank ?></p>
                                    </td>
                                    <td onclick="user_click(this);">
                                        <p><?php echo $user_id; ?></p>
                                    </td>
                                    <td onclick="user_click(this);">
                                        <!-- <input class="input_pw" type="password" name="current_password" placeholder="현재 비밀번호"> -->
                                        <input class="input_pw" type="password" name="new_pw" placeholder="신규 비밀번호">
                                        <!-- <p><?php echo $USER_PW; ?></p> -->
                                    </td>
                                    <td>
                                        <input type="button" onclick="pw_update(this)" value="암호 변경">
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
