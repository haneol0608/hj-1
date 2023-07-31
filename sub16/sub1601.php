<!-- header -->
<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub16'; ?>
<!-- //header -->

<?php 
    $search_str = "WHERE 1 ";

    $search_errPor = $_GET['search_errPor'];
    $search_errinfo = $_GET['search_errinfo'];
    $search_errCount = $_GET['search_errCount'];

    if($search_errPor) { $search_str .= " AND error_por LIKE '%$search_errPor%' "; }
    if($search_errinfo) { $search_str .= " AND error_info LIKE '%$search_errinfo%' "; }
    if($search_errCount) { $search_str .= " AND error_count LIKE '%$search_errCount%' "; }
?>


<div class="content sub11">
    <div class="ct_wrap">
    <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <div class="container sub01">
                <div class="sub_plate">
                    <h3>제품불량 추가</h3>
                    <div class="add_user">
                        <ul>
                            <li>POR번호<span><input type="text" name="error_por"></span></li>
                            <li>불량정보<span><input type="text" name="error_info"></span></li>
                            <li>수량<span><input type="text" name="error_count"></span></li>
                        </ul>
                        <ul>
                            <li><input type="button" onclick="add_error(this);" value="등록"></li>
                        </ul>
                    </div>

                </div>

                <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
                <div class="sub_plate">
                    <h3>제품불량 검색</h3>
                    <div class="add_code">
                        <form action="<?php $_SERVER['PHP_SELF'] . '?search_errPor=' . $search_errPor . '&search_errinfo=' . $search_errinfo . '&search_errCount=' . $search_errCount; ?>">
                            <table>
                                <tr>
                                    <td>POR 번호</td>
                                    <td><input type="text" name="search_errPor" value="<?php echo $search_errPor; ?>"></td>
                                    <td>불량정보</td>
                                    <td><input type="text" name="search_errinfo" value="<?php echo $search_errinfo; ?>"></td>
                                    <td>수량</td>
                                    <td><input type="text" name="search_errCount" value="<?php echo $search_errCount; ?>"></td>
                                    <td><input style="width: 80%; height: 50px;" type="submit" value="검색"></td>
                                </tr>
                            </table>
                        </form>
                    </div> 
                </div>
                <!-- ************************************************************************************ -->

                <div class="sub_plate">
                    <h3>제품불량 리스트</h3>
                    <div class="">
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
                                    <td>불량정보</td>
                                    <td>수량</td>
                                    <td>처리</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $select_query = "SELECT * FROM hj_error $search_str ";
                                $select_result = mysqli_query($conn, $select_query);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $error_por = $row['error_por'];
                                    $error_info = $row['error_info'];
                                    $error_count = $row['error_count'];
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i; ?>
                                        <input type="hidden" name="error_no" value="<?php echo $no; ?>">
                                    </td>
                                    <td>
                                        <p><?php echo $error_por; ?></p>
                                    </td>
                                    <td style="text-align: left;">
                                        <p><?php echo $error_info; ?></p>
                                    </td>
                                    <td >
                                        <p><?php echo $error_count; ?></p>
                                    </td>
                                    <td>
                                        <input type="button" onclick="delete_error(this);" value="삭제">
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
