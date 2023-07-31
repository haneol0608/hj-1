<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub15'; ?>
<!-- //header -->

<?php 
    $search_str = "WHERE 1 ";

    $search_invenKinds = $_GET['search_invenKinds'];
    $search_invenName = $_GET['search_invenName'];
    $search_invenCount = $_GET['search_invenCount'];

    if($search_invenKinds) { $search_str .= " AND inven_kinds LIKE '%$search_invenKinds%' "; }
    if($search_invenName) { $search_str .= " AND inven_name LIKE '%$search_invenName%' "; }
    if($search_invenCount) { $search_str .= " AND inven_count LIKE '%$search_invenCount%' "; }
?>


<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <div class="container sub01">
                <div class="sub_plate">

                    <h3>재고 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>종류<span><input type="text" name="inven_kinds"></span></li>
                            <li>재고명<span><input type="text" name="inven_name"></span></li>
                            <li>수량<span><input type="text" name="inven_count"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_inven(this);" value="등록"></li>
                        </ul>
                    </div>

                </div>

                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>재고 검색</h3>
                    <form action="<?php $_SERVER['PHP_SELF'] . '?search_invenKinds=' . $search_invenKinds . '&search_invenName=' . $search_invenName . '&search_invenCount=' . $search_invenCount; ?>">
                        <table>
                            <tr>
                                <td>종류</td>
                                <td><input style="width: 90%;" type="text" name="search_invenKinds" value="<?php echo $search_invenKinds; ?>"></td>
                                <td>재고명</td>
                                <td><input style="width: 90%;" type="text" name="search_invenName" value="<?php echo $search_invenName; ?>"></td>
                                <td>수량</td>
                                <td><input style="width: 90%;" type="text" name="search_invenCount" value="<?php echo $search_invenCount; ?>"></td>
                                <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- ************************************************************************************ -->

                <div class="sub_plate">
                    <h3>재고 리스트</h3>
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
                                    <td>종류</td>
                                    <td>재고명</td>
                                    <td>수량</td>
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_inven $search_str ";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $inven_kinds = $row['inven_kinds'];
                                    $inven_name = $row['inven_name'];
                                    $inven_count = $row['inven_count'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="inven_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td onclick="user_click(this)">
                                        <p><?php echo $inven_kinds; ?></p>
                                        <input style="display:none;" type="text" name="inven_kinds" value="<?php echo $inven_kinds; ?>">
                                    </td>
                                    <td style="text-align: left;" onclick="user_click(this)">
                                        <p><?php echo $inven_name; ?></p>
                                        <input style="display:none;" type="text" name="inven_name" value="<?php echo $inven_name; ?>">
                                    </td>
                                    <td onclick="user_click(this)">
                                        <p><?php echo $inven_count; ?></p>
                                        <input style="display:none;" type="text" name="inven_count" value="<?php echo $inven_count; ?>">
                                    </td>
                                    <td>
                                        <input type="button" onclick="edit_inven(this);" value="수정">
                                        <input type="button" onclick="delete_inven(this);" value="삭제">
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
