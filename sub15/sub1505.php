<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>

<?php 
    $search_str = " WHERE 1 ";

    $search_ho = $_GET['search_ho'];
    $search_por = $_GET['search_por'];
    $search_seq = $_GET['search_seq'];
    $search_paint = $_GET['search_paint'];
    $search_date1 = $_GET['search_date1'];
    $search_date2 = $_GET['search_date2'];

    if($search_ho) { $search_str .= " AND ship_no LIKE '%$search_ho%' "; }
    if($search_por) { $search_str .= " AND por_no LIKE '%$search_por%' "; }
    if($search_seq) { $search_str .= " AND seq_no LIKE '%$search_seq%' "; }
    if($search_paint) { $search_str .= " AND paint_code LIKE '%$search_paint%' "; }
    if($search_date1 && $search_date2) {
        $search_str .= " AND DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$search_date1' AND '$search_date2' ";
    } else {
        if($search_date1) {
            $date = date("Y-m-d");
            $search_str .= " AND date BETWEEN '$search_date1' AND '$date' ";
        }
    }
?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">

            <!--***************** 20232-03-28. 김한얼 팀장. 시정조치 보완요청 사항 반엉 *****************-->
            <div class="sub_plate">
                <h3>라벨 마킹완료 검색</h3>
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
                            <td>생산일시</td>
                            <td>
                                <input type="date" name="search_date1" value="<?php echo $search_date1; ?>"> ~ <input type="date" name="search_date2" value="<?php echo $search_date2; ?>">
                            </td>
                            <td rowspan="2"><input style="width: 100%; height: 50px;" type="submit" value="검색"></td>
                        </tr>
                    </table>
                </form>
            </div>
            <!-- ************************************************************************************ -->

            <div class="sub_plate">
                <h3>라벨 마킹완료</h3>
                <input type="button" onclick="label_excel();" value="엑셀 다운로드">

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
                                <td>NO</td>
                                <td>호선</td>
                                <td>POR</td>
                                <td>SEQ</td>
                                <td>PAINT</td>
                                <td>생산수량</td>
                                <td>생산일시</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 0;
                                $select_query = "SELECT ship_no, por_no, seq_no, paint_code, COUNT(ship_no) AS count FROM hj_label $search_str GROUP BY ship_no, por_no, seq_no, paint_code ORDER BY date DESC";
                                $select_result = mysqli_query($conn2, $select_query);
                                while($row = mysqli_fetch_assoc($select_result)) {
                                    $i++;
                                    $no = $row['no'];
                                    $ship_no = $row['ship_no'];
                                    $por_no = $row['por_no'];
                                    $seq_no = $row['seq_no'];
                                    $paint_code = $row['paint_code'];
                                    $count = $row['count'];
                            ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                    <input type="hidden" name="no" value="<?php echo $no; ?>">
                                </td>
                                <td><p><?php echo $ship_no; ?></p></td>
                                <td><p><?php echo $por_no; ?></p></td>
                                <td><p><?php echo $seq_no; ?></p></td>
                                <td><p><?php echo $paint_code; ?></p></td>
                                <td><p><?php echo $count; ?></p></td>
                                <td>
                                    <p>
                                        <?php 
                                            $select_date_query = "SELECT * FROM hj_label WHERE ship_no = '$ship_no' AND por_no = '$por_no' AND seq_no = '$seq_no' AND paint_code = '$paint_code' "; 
                                            $select_date_result = mysqli_query($conn2, $select_date_query);
                                            $date_row = mysqli_fetch_assoc($select_date_result);
                                            echo $date = $date_row['date'];
                                        ?>
                                    </p>
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