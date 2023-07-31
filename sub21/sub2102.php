<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub21'; ?>
<?php $_SESSION['page'] = 'sub2102'; ?>

<?php 
    $search_str = "WHERE 1 ";

    $search_date1 = $_GET['search_date1'];
    $search_date2 = $_GET['search_date2'];
    if($search_date1 && $search_date2) {
        // $search_str .= " AND DATE_FORMAT(date2, '%Y-%m-%d') BETWEEN '$search_date1' AND '$search_date2' ";
        $search_str .= " AND (DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$search_date1' AND '$search_date2') ";
    } else {
        if($search_date1) {
            $date = date("Y-m-d");
            // $search_str .= " AND DATE_FORMAT(date2, '%Y-%m-%d') BETWEEN '$search_date1' AND '$date' ";
            $search_str .= " AND (DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$search_date1' AND '$date') ";
        }
    }

    $pro_date1 = $_GET['pro_date1'];
    $pro_date2 = $_GET['pro_date2'];
    if($pro_date1 && $pro_date1) {
        // $search_str .= " AND DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$pro_date1' AND '$pro_date2' ";
        $search_str2 .= " AND (DATE_FORMAT(quantity_ok, '%Y-%m-%d') BETWEEN '$pro_date1' AND '$pro_date2') ";
    } else {
        if($pro_date1) {
            $date = date("Y-m-d");
            // $search_str .= " AND DATE_FORMAT(date, '%Y-%m-%d') BETWEEN '$pro_date1' AND '$date' ";
            $search_str2 .= " AND (DATE_FORMAT(quantity_ok, '%Y-%m-%d') BETWEEN '$pro_date1' AND '$date') ";
        }
    }

    $search_ship_no = $_GET['search_ship_no'];
    if($search_ship_no) {
        $search_str .= " AND ship_no = '$search_ship_no' ";
    }

    $search_por_no = $_GET['search_por_no'];
    if($search_por_no) {
        $search_str .= " AND por_no = '$search_por_no' ";
    }

    $search_seq_no = $_GET['search_seq_no'];
    if($search_seq_no) {
        $search_str .= " AND seq_no = '$search_seq_no' ";
    }

    $search_paint_code = $_GET['search_paint_code'];
    if($search_paint_code) {
        $search_str .= " AND paint_code = '$search_paint_code' ";
    }
?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub2101">
                <div class="sub_plate_union">
                    <div class="sub_plate">
                        <h3>꼬리표 검색</h3>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?search_date1=' . $search_date1 . '&search_date2=' . $search_date2 . '&pro_date1=' . $pro_date1 . '&pro_date2=' . $pro_date2 . '&ship_no=' . $ship_no . '&por_no=' . $por_no . '&seq_no=' . $seq_no . '&paint_code=' . $paint_code; ?>" method="get">
                            <table class="KPI_table">
                                <tr>
                                    <td>지시일자</td>
                                    <td><input type="date" name="pro_date1" value="<?php echo $pro_date1; ?>"> ~ <input type="date" name="pro_date2" value="<?php echo $pro_date2; ?>"></td>
                                    <td>제조일자</td>
                                    <td ><input type="date" name="search_date1" value="<?php echo $search_date1; ?>"> ~ <input type="date" name="search_date2" value="<?php echo $search_date2; ?>"></td>
                                    <td rowspan="4"><input style="width:100%; height:50px;" type="submit" value="검색"></td>
                                </tr>
                                
                                <tr>
                                    <td>호선</td>
                                    <td><input type="text" name="search_ship_no" value="<?php echo $search_ship_no; ?>"></td>
                                    <td>POR</td>
                                    <td><input type="text" name="search_por_no" value="<?php echo $search_por_no; ?>"></td>
                                </tr>

                                <tr>
                                    <td>SEQ</td>
                                    <td><input type="text" name="search_seq_no" value="<?php echo $search_seq_no; ?>"></td>
                                    <td>PAINT</td>
                                    <td><input type="text" name="search_paint_code" value="<?php echo $search_paint_code; ?>"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    <div class="sub_plate">
                        <div class="kpi_p">
                            <h2>
                                KPI 지표
                            </h2>
                                <?php
                                    $diffDate_arr = array();
                                    $count_arr = array();
                                    $errCount_arr = array();

                                    $select_date_query = "SELECT date, TIMESTAMPDIFF(DAY, '$search_date1', date) AS diff_date FROM hj_label $search_str ";
                                    $select_date_result = mysqli_query($conn2, $select_date_query);
                                    while($date_row = mysqli_fetch_assoc($select_date_result)) {
                                        $diff_date = $date_row['diff_date'];
                                        array_push($diffDate_arr, $diff_date);
                                    }

                                    $select_err_query = "SELECT COUNT(ship_no) AS err_count FROM hj_label $search_str AND ((ship_no IS NULL OR ship_no = '-' OR ship_no = '') OR (por_no = '-' OR por_no = '') OR (seq_no = '-' OR seq_no = '')) ";
                                    $select_err_result = mysqli_query($conn2, $select_err_query);
                                    while($err_row = mysqli_fetch_assoc($select_err_result)) {
                                        $err_count = $err_row['err_count'];
                                        array_push($errCount_arr, $err_count);
                                    }

                                    $select_query = "SELECT ship_no, por_no, seq_no, paint_code, COUNT(ship_no) AS count FROM hj_label $search_str GROUP BY ship_no, por_no, seq_no, paint_code ORDER BY date DESC ";
                                    $select_result = mysqli_query($conn2, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                        $count = $row['count'];
                                        array_push($count_arr, $count);
                                    }
                                ?>
                            <?php 
                                // if($search_date1 == null OR $search_date1 == '') {
                            ?>
                                <!-- <p style="color: red; font-weight: bold;">제조일자를 검색해주세요!!<p> -->
                            <?php //} else { ?>
                                <p>
                                제조리드타임 : <?php echo round( array_sum($diffDate_arr) / count($diffDate_arr), 0 ) . " 일"; ?> / 불량률 : <?php echo round( ( array_sum($errCount_arr) / array_sum($count_arr) ) * 100, 2); ?> / 생산수량 : <?php echo array_sum($count_arr) . " 개"; ?> / 불량수량 : <?php echo array_sum($errCount_arr) . " 개"; ?> 
                                </p>
                            <?php //} ?>
                        </div>
                        
                        <div>
                            <table>
                                <tr>
                                    <td>지시일자</td>
                                    <td><p><?php echo $pro_date1; ?> ~ <?php echo $pro_date2; ?></p></td>
                                </tr>
                                <tr>
                                    <td>제조일자</td>
                                    <td><p><?php echo $search_date1; ?> ~ <?php echo $search_date2; ?></p></td>
                                </tr>
                                <tr>
                                    <td>호선 / POR</td>
                                    <td><p><?php echo $search_ship_no; ?> / <?php echo $search_por_no; ?></p></td>
                                </tr>
                                <tr>
                                    <td>SEQ / PAINT</td>
                                    <td><p><?php echo $search_seq_no; ?> / <?php echo $search_paint_code; ?></p></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <div class="sub_plate">
                    <h3>제조리드타임</h3>
                    <div class="body_div">
                        <table>
                            <thead>
                                <tr>
                                    <td>호선</td>
                                    <td>POR</td>
                                    <td>SEQ</td>
                                    <td>PAINT</td>
                                    <td>BLOCK</td>
                                    <td>PCS</td>
                                    <td>LOT</td>
                                    <td>생산 수량</td>
                                    <td>지시 일자</td>
                                    <td>제조 일자</td>
                                    <td>제조리드타임(일)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                    
                                    $select_query = "SELECT ship_no, por_no, seq_no, paint_code, COUNT(ship_no) AS count FROM hj_label $search_str GROUP BY ship_no, por_no, seq_no, paint_code ORDER BY date DESC LIMIT 100 ";
                                    $select_result = mysqli_query($conn2, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                        $i++;
                                        $no = $row['no'];
                                        $ship_no = $row['ship_no'];
                                        $por_no = $row['por_no'];
                                        $seq_no = $row['seq_no'];
                                        $paint_code = $row['paint_code'];
                                        $block_no = $row['block_no'];
                                        $pcs_no = $row['pcs_no'];
                                        $lot_no = $row['lot_no'];
                                        $count = $row['count'];
                                        
                                        $select_lada_query = "SELECT quantity_ok FROM hj_lada WHERE  ho = '$ship_no' AND por = '$por_no' AND  seq = '$seq_no' $search_str2 ";
                                        $select_lada_result = mysqli_query($conn, $select_lada_query);
                                        $lada_row = mysqli_fetch_assoc($select_lada_result);
                                        $quantity_ok = $lada_row['quantity_ok'];
                                        
                                        $select_date_query = "SELECT date, TIMESTAMPDIFF(DAY, '$quantity_ok', date) AS diff_date FROM hj_label WHERE ship_no = '$ship_no' AND por_no = '$por_no' AND seq_no = '$seq_no' AND paint_code = '$paint_code' "; 
                                        $select_date_result = mysqli_query($conn2, $select_date_query);
                                        $date_row = mysqli_fetch_assoc($select_date_result);
                                        
                                        $date = $date_row['date'];
                                        $diff_date = $date_row['diff_date'];
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="no" value="<?php echo $no; ?>">
                                        <p><?php echo $ship_no; ?></p>
                                    </td>
                                    <td><p><?php echo $por_no; ?></p></td>
                                    <td><p><?php echo $seq_no; ?></p></td>
                                    <td><p><?php echo $paint_code; ?></p></td>
                                    <td><p><?php echo $block_no; ?></p></td>
                                    <td><p><?php echo $pcs_no; ?></p></td>
                                    <td><p><?php echo $lot_no; ?></p></td>
                                    <td style="text-align: right;"><p><?php echo $count; ?></p></td>
                                    <td>
                                        <p>
                                        <?php 
                                            if($quantity_ok == null OR $quantity_ok == '') {
                                                echo "<p style='color: blue; font-weight: bold;'>임의생산</p>";
                                            } else {
                                                echo $quantity_ok;
                                            }
                                        ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                        <?php 
                                            echo $date;
                                        ?>
                                        </p>
                                    </td>
                                    <td style="text-align: right;"><?php echo $diff_date; ?></td>
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
