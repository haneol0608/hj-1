<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub15'; ?>
<!-- //header -->

<?php 
    $search_str = "WHERE 1 ";
    $search_str2 = "HAVING ";

    $search_por = $_GET['search_por'];
    $search_name = $_GET['search_name'];
    $search_count = $_GET['search_count'];

    if($search_por) { $search_str .= " AND por LIKE '%$search_por%' "; }
    if($search_name) { $search_str .= " AND name LIKE '%$search_name%' "; }
    if($search_count) { $search_str .= " AND count LIKE '%$search_count%' "; }
?>

<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <div class="container sub01">
                <div class="sub_plate">

                    <h3>가공공정 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>POR번호<span><input type="text" name="pro2_por"></span></li>
                            <li>공정명<span><input type="text" name="pro2_name"></span></li>
                            <li>수량<span><input type="text" name="pro2_count"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_pro2(this);" value="등록"></li>
                        </ul>
                    </div>

                </div>

                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>가공공정 검색</h3>
                    <form action="<?php $_SERVER['PHP_SELF'] . '?search_por=' . $search_por . '&search_name=' . $search_name . '&search_invenCount=' . $search_invenCount; ?>">
                        <table>
                            <tr>
                                <td>POR번호</td>
                                <td><input style="width: 90%;" type="text" name="search_por" value="<?php echo $search_por; ?>"></td>
                                <td>공정명</td>
                                <td><input style="width: 90%;" type="text" name="search_name" value="<?php echo $search_name; ?>"></td>
                                <td>수량</td>
                                <td><input style="width: 90%;" type="text" name="search_count" value="<?php echo $search_count; ?>"></td>
                                <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- ************************************************************************************ -->

                <div class="sub_plate">
                    <h3>가공공정 리스트</h3>
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
                                    <td>POR번호</td>
                                    <td>공정명</td>
                                    <td>수량</td>
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_pro2 $search_str ";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $por = $row['por'];
                                    $name = $row['name'];
                                    $count = $row['count'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="pro2_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td onclick="user_click(this)">
                                        <p><?php echo $por; ?></p>
                                        <input style="display:none;" type="text" name="pro2_por" value="<?php echo $por; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $name; ?></p>
                                        <input style="display:none;" type="text" name="pro2_name" value="<?php echo $name; ?>">
                                    </td>
                                    <td onclick="user_click(this)">
                                        <p><?php echo $count; ?></p>
                                        <input style="display:none;" type="text" name="pro2_count" value="<?php echo $count; ?>">
                                    </td>
                                    <td>
                                        <input type="button" onclick="edit_pro2(this);" value="수정">
                                        <input type="button" onclick="delete_pro2(this);" value="삭제">
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
