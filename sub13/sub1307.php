<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub13'; ?>
<!-- //header -->

<?php 
    $search_str = " WHERE 1 ";

    $search_work = $_GET['search_work'];
    $search_workMan = $_GET['search_workMan'];

    if($search_work) {$search_str .= " AND work LIKE '%$search_work%' ";}
    if($search_workMan) {$search_str .= " AND work_man LIKE '%$search_workMan%' ";}
?>

<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <div class="container sub01">
                <div class="sub_plate">

                    <h3>작업일보 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>공정명<span><input type="text" name="work"></span></li>
                            <li>담당자<span><input type="text" name="work_man"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_daywork(this)" value="등록"></li>
                        </ul>
                    </div>

                </div>

                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>작업일보 검색</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . "?search_work=" . $search_work . '&search_workMan=' . $search_workMan . '&search_seq=' . $search_seq . '&search_lap=' . $search_lap . '&search_series=' . $search_series . '&search_weight=' . $search_weight . '&search_paint=' . $search_paint . '&search_proDate1=' . $search_proDate1 . '&search_proDate2=' . $search_proDate2 . '&search_mpDate1=' . $search_mpDate1 . '&search_mpDate2=' . $search_mpDate2; ?>">
                        <table>
                            <tr>
                                <td>공정명</td>
                                <td>
                                    <input style="width: 90%;" type="text" name="search_work" value="<?php echo $search_work; ?>">
                                </td>
                                <td>담당자</td>
                                <td><input style="width: 90%;" type="text" name="search_workMan" value="<?php echo $search_workMan; ?>"></td>
                                <td><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- ************************************************************************************ -->

                <div class="sub_plate">
                    <h3>작업일보 리스트</h3>
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
                                    <td>공정명</td>
                                    <td>담당자</td>
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_daywork $search_str ";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $work = $row['work'];
                                    $work_man = $row['work_man'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="work_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $work; ?></p>
                                        <input style="display:none;" type="text" name="edit_work" value="<?php echo $work; ?>">
                                    </td>
                                    <td style="text-align: center;" onclick="user_click(this)">
                                        <p><?php echo $work_man; ?></p>
                                        <input style="display:none;" type="text" name="edit_work_man" value="<?php echo $work_man; ?>">
                                    </td>
                                    <td>
                                        <input type="button" onclick="edit_daywork(this)" value="수정">
                                        <input type="button" onclick="delete_daywork(this)" value="삭제">
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
