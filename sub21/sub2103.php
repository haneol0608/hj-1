<?php include "../layout/header.php"; ?>
<?php include '../include/dbcon.php'; ?>
<?php $_SESSION['NAV'] = 'sub21'; ?>
<?php $_SESSION['page'] = 'sub2103'; ?>

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

    $search_ho = $_GET['search_ho'];
    if($search_ho) {
        $search_str .= " AND ho = '$search_ho' ";
    }

    $search_por = $_GET['search_por'];
    if($search_por) {
        $search_str .= " AND por = '$search_por' ";
    }

    $search_seq = $_GET['search_seq'];
    if($search_seq) {
        $search_str .= " AND seq = '$search_seq' ";
    }

    $search_qt_no = $_GET['search_qt_no'];
    if($search_qt_no) {
        $search_str .= " AND qt_no LIKE '%$search_qt_no%' ";
    }

    $search_user = $_GET['search_user'];
    $search_value = $_GET['search_value'];
    if($search_user && $search_value) {
        if($search_user == "id") {
            $search_str .= " AND id = '$search_value' ";
        } else if ($search_user == "name") {
            $search_str .= " AND name = '$search_value' ";
        }
    }
?>

<div class="content sub01">
    <div class="ct_wrap">
        <?php include "../layout/nav2.php" ?>
        <div class="container_ct">
            <div class="container sub2103">
                <div class="sub_plate">
                    <h3>로그 검색</h3>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . '?search_ho=' . $search_ho . '&search_por=' . $search_por . '&search_seq=' . $search_seq . '&search_qt_no=' . $search_qt_no . '&search_user=' . $search_user . '&search_value=' . $search_value . '&search_func=' . $search_func . '&search_date1=' . $search_date1 . '&search_date2=' . $search_date2; ?>" method="get">
                        <table class="KPI_table">
                            <tr>
                                <td>호선</td>
                                <td><input type="text" name="search_ho" value="<?php echo $search_ho; ?>"></td>
                                <td>POR</td>
                                <td><input type="text" name="search_por" value="<?php echo $search_por; ?>"></td>
                                <td rowspan="4"><input style="width:100%; height:50px;" type="submit" value="검색"></td>
                            </tr>
                            <tr>
                                <td>SEQ</td>
                                <td><input type="text" name="search_seq" value="<?php echo $search_seq; ?>"></td>
                                <td>QT_NO</td>
                                <td><input type="text" name="search_qt_no" value="<?php echo $search_qt_no; ?>"></td>
                            </tr>
                            <tr>
                                <td>사용자</td>
                                <td>
                                    <select name="search_user">
                                        <option value="">----</option>
                                        <option <?php if($search_user=='id') { echo "selected"; } ?> value="id">아이디</option>
                                        <option <?php if($search_user=='name') { echo "selected"; } ?> value="name">사용자명</option>
                                    </select>
                                    <input type="text" name="search_value" value="<?php echo $search_value; ?>">
                                </td>
                                <td>이력</td>
                                <td><input type="text" name="search_func" value="<?php echo $search_func; ?>"></td>
                            </tr>
                            <tr>
                                <td>사용일자</td>
                                <td colspan="3"><input type="date" name="search_date1" value="<?php echo $search_date1; ?>"> ~ <input type="date" name="search_date2" value="<?php echo $search_date2; ?>"></td>
                            </tr>
                        </table>    
                    </form>
                </div>
                <div class="sub_plate">
                    <h3>로그 리스트</h3>
                    <div class="body_div">
                        <table>
                            <thead>
                                <tr>
                                    <td>no</td>
                                    <td>호선</td>
                                    <td>POR</td>
                                    <td>SEQ</td>
                                    <td>QT_NO</td>
                                    <td>아이디</td>
                                    <td>사용자명</td>
                                    <td>사용이력</td>
                                    <td>사용일자</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 0;
                                    $select_query = "SELECT ho, por, seq, qt_no, id, name, func, date FROM `hj_log` $search_str GROUP BY ho, por, seq, qt_no, id, name, func, date ORDER BY date DESC LIMIT 500";
                                    // $select_query = "SELECT ship_no, por_no, seq_no, paint_code, COUNT(ship_no) AS count FROM hj_label $search_str GROUP BY ship_no, por_no, seq_no, paint_code ORDER BY date DESC  ";
                                    $select_result = mysqli_query($conn, $select_query);
                                    while($row = mysqli_fetch_assoc($select_result)) {
                                        // $no = $row['no'];
                                        $no++;
                                        $ho = $row['ho'];
                                        $por = $row['por'];
                                        $seq = $row['seq'];
                                        $qt_no = $row['qt_no'];
                                        $id = $row['id'];
                                        $name = $row['name'];
                                        $func = $row['func'];
                                        $date = $row['date'];
                                ?>
                                <tr>
                                    <td>
                                        <input type="hidden" name="no" value="<?php echo $no; ?>">
                                        <p><?php echo $no; ?></p>
                                    </td>
                                    <td><p><?php echo $ho; ?></p></td>
                                    <td><p><?php echo $por; ?></p></td>
                                    <td><p><?php echo $seq; ?></p></td>
                                    <td><p><?php echo $qt_no; ?></p></td>
                                    <td><p><?php echo $id; ?></p></td>
                                    <td><p><?php echo $name; ?></p></td>
                                    <td><p><?php echo $func; ?></p></td>
                                    <td><p><?php echo $date; ?></p></td>                                        
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
