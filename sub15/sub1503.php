<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php 
    $search_str = " AND 1 ";

    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_paint = $_GET['search_paint'];

    if($search_ho) { $search_str .= " AND ho LIKE '%$search_ho%' "; }
    if($search_por) { $search_str .= " AND por LIKE '%$search_por%' "; }
    if($search_seq) { $search_str .= " AND seq LIKE '%$search_seq%' "; }
    if($search_paint) { $search_str .= " AND paint LIKE '%$search_paint%' "; }
?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
            <div class="sub_plate">
                <h3>라벨 마킹대기 검색</h3>
                <form action="<?php $_SERVER['PHP_SELF'] . '?search_ho=' . $search_ho . '&search_por=' . $search_por . '&search_seq=' . $search_seq . '&search_paint=' . $search_paint; ?>">
                    <table>
                        <tr>
                            <td>호선</td>
                            <td><input style="width: 90%;" type="text" name="search_ho" value="<?php echo $search_ho; ?>"></td>
                            <td>POR</td>
                            <td><input style="width: 90%;" type="text" name="search_por" value="<?php echo $search_por; ?>"></td>
                            <td>SEQ</td>
                            <td><input style="width: 90%;" type="text" name="search_seq" value="<?php echo $search_seq; ?>"></td>
                            <td>PAINT</td>
                            <td><input style="width: 90%;" type="text" name="search_paint" value="<?php echo $search_paint; ?>"></td>
                            <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <!-- ************************************************************************************ -->

            <div class="sub_plate">
                <h3>라벨 마킹대기</h3>

                <div class="draw_table">
                    <?php 
                        $select_table_query = "SELECT * FROM hj_table WHERE ok = 'Y' ";
                        $table_result = mysqli_query($conn, $select_table_query);
                        $table_row = mysqli_fetch_assoc($table_result);
                        $style = $table_row['style'];
                    ?>
                    <table class="<?php echo $style; ?>">
                        <thead>
                            <tr>
                                <td>마킹순서</td>
                                <td>호선</td>
                                <td>POR</td>
                                <td>SEQ</td>
                                <td>PAINT</td>
                                <td>기타(블록 등) - 한글 금지</td>
                                <td>라벨 수량</td>
                                <td>처리</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $select_query = "SELECT * FROM hj_label WHERE stat = '마킹대기' $search_str ";
                                $select_result = mysqli_query($conn, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $la_no = $row['la_no'];
                                    $no = $row['no'];
                                    $ho = $row['ho'];
                                    $por = $row['por'];
                                    $seq = $row['seq'];
                                    $paint = $row['paint'];
                                    $other = $row['other'];
                                    $count = $row['count'];
                            ?>
                            <tr>
                                <td>
                                    <input type="text" name="la_no" value="<?php echo $la_no; ?>">
                                </td>
                                <td><?php echo $ho; ?></td>
                                <td><?php echo $por; ?></td>
                                <td><?php echo $seq; ?></td>
                                <td><?php echo $paint; ?></td>
                                <td>
                                    <input type="text" name="other" value="<?php echo $other; ?>">
                                </td>
                                <td>
                                    <input type="text" name="count" value="<?php echo $count; ?>">
                                </td>
                                <td>
                                    <!-- <input type="button" onclick="labelWait_up(<?php echo $no; ?>);" value="저장"> -->
                                    <input type="button" onclick="label_start(this, <?php echo $no; ?>);" value="라벨 등록">
                                    <input type="button" onclick="labelWait_del(this, <?php echo $no; ?>);" value="삭제">
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

<?php include "../layout/footer.php"; ?>