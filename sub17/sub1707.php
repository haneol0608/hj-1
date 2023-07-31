<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub17'; ?>
<!-- //header -->
<?php
  $search_str = "WHERE 1 ";

  $s_screen = $_GET['s_screen'];
  $s_content = $_GET['s_content'];
  $s_user = $_GET['s_user'];

  if($s_screen) { 
    $search_str .= " AND screen LIKE '%$s_screen%' "; 
  }
  if($s_content) { 
    $search_str .= " AND content LIKE '%$s_content%' "; 
  }
  if($s_user) { 
    $search_str .= " AND user LIKE '%$s_user%' "; 
  }
?>
<div class="content sub11">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub01">
                <div class="sub_plate">
                    <h3>사용이력 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>화면명<span><input type="text" name="screen"></span></li>
                            <li>사용이력<span><input type="text" name="content"></span></li>
                            <li>사용자<span><input type="text" name="user"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_use_record(this);" value="등록"></li>
                        </ul>
                    </div>
                </div>

                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>사용이력 검색</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?s_screen=' . $s_screen . '&s_content=' . $s_content . '&s_user=' . $s_user; ?>">
                        <table>
                            <tr>
                                <td>화면명</td>
                                <td>
                                    <input style="width: 90%;" type="text" name="s_screen" placeholder="(검색어)화면명" value="<?php echo $s_screen; ?>">
                                </td>
                                <td>사용이력</td>
                                <td>
                                    <input style="width: 90%;" type="text" name="s_content" placeholder="(검색어)사용이력" value="<?php echo $s_content; ?>">
                                </td>
                                <td>사용자</td>
                                <td>
                                    <input style="width: 90%;" type="text" name="s_user" placeholder="(검색어)사용자" value="<?php echo $s_user; ?>">
                                </td>
                                <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- ************************************************************************************ -->
                <div class="sub_plate">
                    <h3>사용이력 리스트</h3>
                    <div class="drawing_table">
                        <?php 
                            $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                            $table_result = mysqli_query($conn, $select_table_query);
                            $table_row = mysqli_fetch_assoc($table_result);
                            $style = $table_row['style'];
                        ?>
                        <table class="<?php echo $style; ?>">
                            <thead>
                                <tr>
                                    <td>no</td>
                                    <td>화면명</td>
                                    <td>사용이력</td>
                                    <td>사용자</td>
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_record $search_str";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $content = $row['content'];
                                    $screen = $row['screen'];
                                    $user = $row['user'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="no" value="<?php echo $no; ?>">
                                    </td>
                                    <td onclick="user_click(this)">
                                        <p><?php echo $screen; ?></p>
                                        <input style="display:none;" type="text" name="screen" value="<?php echo $screen; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $content; ?></p>
                                        <input style="display:none;" type="text" name="content" value="<?php echo $content; ?>">
                                    </td>
                                    <td onclick="user_click(this)">
                                        <p><?php echo $user; ?></p>
                                        <input style="display:none;" type="text" name="user" value="<?php echo $user; ?>">
                                    </td>
                                    <td>
                                        <input type="button" onclick="edit_use_record(this);" value="수정">
                                        <input type="button" onclick="delete_use_record(this);" value="삭제">
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
