<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub11'; ?>
<!-- //header -->
<?php
    $s_user_id = $_GET['s_user_id'];
    $s_user_power = $_GET['s_user_power'];

    $search_str = "WHERE 1";
    
    if($s_user_id){
        $search_str .= " AND user_id LIKE '%$s_user_id%' ";
    }
    if($s_user_power){
        $search_str .= " AND user_power LIKE '%$s_user_power%' ";
    }
    
?>


<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub11">
                <div class="sub_plate">
                    <h3>사용자 검색</h3>
                    <div class="add_code">
                        <form action="<?php $_SERVER['PHP_SELF'] . '?s_user_id=' . $s_user_id . '&s_user_power=' . $s_user_power; ?>">
                            <table>
                                <tr>
                                    <td>아이디</td>
                                    <td><input type="text" name="s_user_id" placeholder="(검색어)아이디" value="<?php echo $s_user_id?>"></td>
                                    <td>권한</td>
                                    <td><input type="text" name="s_user_power" placeholder="(검색어)권한" value="<?php echo $s_user_power?>"></td>
                                    <td><input type="submit" value="검색"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                
                <div class="sub_plate">
                    <h3>사용자 정보관리</h3>
                    <?php 
                        $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                        $table_result = mysqli_query($conn, $select_table_query);
                        $table_row = mysqli_fetch_assoc($table_result);
                        $style = $table_row['style'];
                    ?>
                    <div class="">
                        <table class="<?php echo $style; ?>">
                            <caption style="text-align:right">
                                <input type="button" value="출력">
                            </caption>
                            <thead>
                                <tr>
                                    <td>아이디</td>
                                    <td>권한</td>
                                    <td>권한 설정</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $select_query = "SELECT * FROM hj_user $search_str ORDER BY no DESC ";
                                    $select_result = mysqli_query($conn, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                        $no = htmlspecialchars($row['no']);
                                        $user_id = htmlspecialchars($row['user_id']);
                                        $user_power = htmlspecialchars($row['user_power']);
                                ?>
                                <tr>
                                    <td><?php echo $user_id; ?></td>
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
                                        <input type="button" onclick="power_update(this, '<?php echo $user_id; ?>');" value="수정">
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
