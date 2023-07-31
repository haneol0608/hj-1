<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php 
    $search_str = " AND 1 ";

    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_paint = $_GET['search_paint'];
    $search_date1 = $_GET['search_date1'];
    $search_date2 = $_GET['search_date2'];

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
                <h3>라벨 마킹 검색</h3>
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
                <h3>라벨 마킹</h3>
                <input type="button" onclick="label_excel();" value="업로드">

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
                                <td>기타(블록 등)</td>
                                <!-- <td>라벨 수량</td> -->
                                <td>처리</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $date = date("Y-m-d");
                                // $select_query = "SELECT * FROM hj_label WHERE stat = '마킹' AND date = '$date' ORDER BY la_no ASC";
                                $select_query = "SELECT * FROM hj_label WHERE stat = '마킹' $search_str ORDER BY la_no ASC";
                                $select_result = mysqli_query($conn, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $no = $row['no'];
                                    $la_no = $row['la_no'];
                                    $ho = $row['ho'];
                                    $por = $row['por'];
                                    $seq = $row['seq'];
                                    $paint = $row['paint'];
                                    $other = $row['other'];
                                    $count = $row['count'];
                            ?>
                            <tr>
                                <td><?php echo $la_no; ?></td>
                                <td><?php echo $ho; ?></td>
                                <td><?php echo $por; ?></td>
                                <td><?php echo $seq; ?></td>
                                <td><?php echo $paint; ?></td>
                                <td><?php echo $other; ?></td>
                                <!-- <td><?php echo $count . " 개"; ?></td> -->
                                <td>
                                    <input type="button" onclick="label_cancle(<?php echo $no; ?>);" value="라벨 취소">
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